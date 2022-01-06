pipeline {   
    agent any
    
    stages {
        stage('Ready deploy to server') {
            steps{
                echo "ready"
            }   
        } 
        
        stage('Build Docker') {
            steps {
                sh 'node --version'
            }
        }
        
        stage('Deployment To Server aris') {
            steps{
                echo "deploy to apache2"
                    sshagent(credentials: ['Apache2']) {
                        sh "cd .."
                            sh "ls"
                                sh "scp -r * root@3.133.84.143:/var/www/html/stroberi"
                                    //sh "ssh root@3.111.35.31 cd /var/www/html/stroberi && pwd && git pull origin master"
                 }    
            }
        }
        
    } 
}
