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
                    sh "curl -s -X POST https://api.telegram.org/bot5021645900:AAFxQI0ltL5dRTNHqLfhg1Ko1ll7hUujjp8/sendMessage -d chat_id=-1001131394773 -d text='Dear Team // CI-CD Pipeline Projectaldo Successfully Build To Server'"
                    sh "scp -r * root@3.133.84.143:/var/www/html/projectaldo"
                    //sh "ssh root@3.111.35.31 cd /var/www/html/stroberi && pwd && git pull origin master"
                    
                 }    
            }
        } 

        stage("Notifications") {
            steps{
				deleteDir()
                echo "Job Success"
                notifications(telegram_url: telegram_url, telegram_chatid: telegram_chatid, 
                job: env.JOB_NAME, job_numb: env.BUILD_NUMBER, job_url: env.BUILD_URL, job_status: job_success, unitTest_score: unitTest_score
                )
            }
        } catch (e) { 

        stage("Error") {
			deleteDir()
            echo "Job Failed"
            notifications(telegram_url: telegram_url, telegram_chatid: telegram_chatid, 
            job: env.JOB_NAME, job_numb: env.BUILD_NUMBER, job_url: env.BUILD_URL, job_status: job_error, unitTest_score: unitTest_score
            )
        }    
            }
        }
        
    } 
}
