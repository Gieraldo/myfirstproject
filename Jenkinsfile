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
		    sh "scp -r * root@3.133.87.10:/var/www/html/stroberi"	    
                    //sh "ssh root@3.111.35.31 cd /var/www/html/stroberi && pwd && git pull origin master"
                 }    
            } 
        } 

        stage("Notifications") {
		steps{
		   echo "Send Notification to Telegram"
		   sh "curl -s -X POST https://api.telegram.org/bot5021645900:AAFxQI0ltL5dRTNHqLfhg1Ko1ll7hUujjp8/sendMessage -d chat_id=-1001131394773 -d text='Dear Team \n\n CI-CD Pipeline Aldo SUCCESS Build with Jenkins \n More info at: http://18.222.143.240:8080/job/testing-aldo/'"
		}
        } 
      
    } 
}
