pipeline {
    agent any

    environment {
        COMPOSE_FILE = 'docker-compose.yml'
    }

    stages {

        stage('Clone Repository') {
            steps {
                git branch: 'main', url: 'https://github.com/manzarvicky/student_php_mysql_app.git'
            }
        }

        stage('Build Docker Images') {
            steps {
                script {
                    // Stop previous containers if running
                    sh 'docker-compose -f $COMPOSE_FILE down || true'

                    // Build new images
                    sh 'docker-compose -f $COMPOSE_FILE build'
                }
            }
        }

        stage('Start Containers') {
            steps {
                script {
                    sh 'docker-compose -f $COMPOSE_FILE up -d'
                }
            }
        }

        stage('Health Check') {
            steps {
                script {
                    // Wait for container startup
                    sh 'sleep 15'

                    // Check if the PHP app is accessible
                    sh 'curl --fail http://localhost:8000 || (echo "App is not healthy!" && exit 1)'
                }
            }
        }

        stage('Post-Deployment Actions') {
            steps {
                echo 'App deployed and verified.'
            }
        }

        stage('Clean Up') {
            steps {
                script {
                    sh 'docker-compose -f $COMPOSE_FILE down'
                }
            }
        }
    }

    post {
        always {
            echo 'Cleaning up unused Docker resources...'
            sh 'docker system prune -f || true'
        }
    }
}
