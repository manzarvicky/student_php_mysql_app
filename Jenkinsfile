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
                    // Optional: Stop previous containers
                    sh 'docker-compose -f $COMPOSE_FILE down || true'

                    // Build new images
                    sh 'docker-compose -f $COMPOSE_FILE build'
                }
            }
        }

        stage('Health Check') {
            steps {
                script {
                    // Build-only test run
                    sh 'docker-compose -f $COMPOSE_FILE up -d'

                    // Wait and test app
                    sh '''
                        echo "Waiting for app..."
                        sleep 15
                        curl --fail http://localhost:8000 || (echo "App is not healthy!" && exit 1)
                        docker-compose -f $COMPOSE_FILE down
                    '''
                }
            }
        }

        stage('Post-Deployment Actions') {
            steps {
                echo 'App built, tested, and verified.'
            }
        }
    }

    post {
        success {
            echo 'Starting Docker containers after full pipeline success...'
            sh 'docker-compose -f $COMPOSE_FILE up -d'
        }

        always {
            echo 'Cleaning up unused Docker resources...'
            sh 'docker system prune -f || true'
        }
    }
}
