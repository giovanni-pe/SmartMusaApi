terraform {
  required_providers {
    google = {
      source  = "hashicorp/google"
      version = "~> 4.0"  # Asegúrate de usar una versión compatible
    }
  }
}

provider "google" {
  project = var.project_id
  region  = var.region
  # Si usas zonas, puedes agregar:
  # zone = "us-central1-a"
}

# Habilitar las APIs necesarias
resource "google_project_service" "cloud_run" {
  service = "run.googleapis.com"
}

resource "google_project_service" "artifact_registry" {
  service = "artifactregistry.googleapis.com"
}

resource "google_project_service" "cloud_build" {
  service = "cloudbuild.googleapis.com"
}

resource "google_project_service" "sqladmin" {
  service = "sqladmin.googleapis.com"
}

# Crear repositorio en Artifact Registry
resource "google_artifact_registry_repository" "repo" {
  provider      = google
  location      = var.region
  repository_id = var.artifact_registry_repository
  format        = "DOCKER"
}

# Construir y subir la imagen Docker usando Cloud Build
resource "google_cloudbuild_trigger" "docker_build" {
  name        = "build-laravel-app"
  description = "Build Docker image and push to Artifact Registry"

  github {
    owner = "TU_USUARIO_GITHUB"
    name  = "TU_REPOSITORIO"
    push {
      branch = "^main$"
    }
  }

  filename = "cloudbuild.yaml"
}

# Crear una instancia de Cloud SQL (MySQL)
resource "google_sql_database_instance" "default" {
  name             = var.db_instance_name
  database_version = "MYSQL_8_0"
  region           = var.region

  settings {
    tier = var.db_tier
  }

  deletion_protection = false
}

# Crear la base de datos
resource "google_sql_database" "database" {
  name     = var.db_name
  instance = google_sql_database_instance.default.name
}

# Crear el usuario de la base de datos
resource "google_sql_user" "users" {
  name     = var.db_user
  instance = google_sql_database_instance.default.name
  password = var.db_password
}

# Crear servicio de Cloud Run
resource "google_cloud_run_service" "default" {
  name     = var.service_name
  location = var.region

  template {
    spec {
      # Asignar el Service Account al servicio de Cloud Run
      service_account_name = google_service_account.cloud_run_sa.email

      containers {
        image = "${var.region}-docker.pkg.dev/${var.project_id}/${var.artifact_registry_repository}/${var.service_name}:latest"

        # Variables de entorno
        env {
          name  = "APP_ENV"
          value = var.app_env
        }
        # Agrega aquí otras variables de entorno según sea necesario
      }
    }

    metadata {
      annotations = {
        "run.googleapis.com/cloudsql-instances" = google_sql_database_instance.default.connection_name
      }
    }
  }

  traffic {
    percent         = 100
    latest_revision = true
  }

  depends_on = [
    google_artifact_registry_repository.repo,
    google_sql_database_instance.default,
    google_service_account.cloud_run_sa  # Asegura que el Service Account se cree antes
  ]
}


# Crear un Service Account para el servicio de Cloud Run
resource "google_service_account" "cloud_run_sa" {
  account_id   = "${var.service_name}-sa"
  display_name = "${var.service_name} Service Account"
}

resource "google_project_iam_member" "run_cloudsql" {
  project = var.project_id
  role    = "roles/cloudsql.client"
  member  = "serviceAccount:${google_service_account.cloud_run_sa.email}"
}

