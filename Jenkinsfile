pipeline {   
    agent any    
       
    stages {
        stage('Ready To Deploy') {
            steps{
                echo "ready"
            }   
        }
        
        stage('Deployment To Server') {
            steps{
                echo "deploy to apache2"
                    sshagent(credentials: ['Apache2']) {
                    sh "cd .."
                    sh "ls"
                    //sh "curl -s -X POST https://api.telegram.org/bot5021645900:AAFxQI0ltL5dRTNHqLfhg1Ko1ll7hUujjp8/sendMessage -d chat_id=-1001131394773 -d text='CI-CD Pipeline For Project Aldo Has Been Successfully Deploy To Server Aris'"
                    //sh "scp -r * root@3.133.84.143:/var/www/html/aldo"
                    //sh "ssh root@3.111.35.31 cd /var/www/html/stroberi && pwd && git pull origin master"
                    
                 }    
            } 
        } 

        stage("Notifications") {
            steps{
		sh "curl -s -X POST https://api.telegram.org/bot5021645900:AAFxQI0ltL5dRTNHqLfhg1Ko1ll7hUujjp8/sendMessage -d chat_id=-1001131394773 -d 
                  text='Dear Team // CI-CD Pipeline SUCCESS with build'"
                sh "scp -r * root@3.133.84.143:/var/www/html/aldo"

            }
        } 
      
    } 
}
