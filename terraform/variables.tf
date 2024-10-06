variable "project_id" {
  description = "smartmusa"
  type        = string
}

variable "region" {
  description = "Región donde se desplegarán los recursos"
  type        = string
}

variable "artifact_registry_repository" {
  description = "Nombre del repositorio en Artifact Registry"
  type        = string
}

variable "service_name" {
  description = "Nombre del servicio de Cloud Run"
  type        = string
}

# Variables para la base de datos
variable "db_instance_name" {
  description = "Nombre de la instancia de Cloud SQL"
  type        = string
  default     = "laravel-db"
}

variable "db_name" {
  description = "Nombre de la base de datos"
  type        = string
  default     = "smartmusa_prod"
}

variable "db_user" {
  description = "Usuario de la base de datos"
  type        = string
  default     = "prod_user"
}

variable "db_password" {
  description = "Contraseña de la base de datos"
  type        = string
}

variable "db_tier" {
  description = "Máquina de la base de datos"
  type        = string
  default     = "db-f1-micro"
}

# Variables para entornos
variable "app_env" {
  description = "Entorno de la aplicación (production, staging, etc.)"
  type        = string
  default     = "production"
}
