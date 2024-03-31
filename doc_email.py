
import smtplib
import sys

def send_email(sender, recipient, subject, body):
    message = f"Subject: {subject}\n\n{body}"
    server = smtplib.SMTP("smtp.gmail.com", 587)
    server.starttls()
    server.login(sender, "mnfayotfshxpriul")
    server.sendmail(sender, recipient, message)
    server.quit()

if __name__ == "__main__":
    doc_email = sys.argv[1]
    doc_id = sys.argv[2]
    doc_password = sys.argv[3]
    doc_name= sys.argv[4]
    
    subject = "Hye!! Your registration As a Doctor is done Successfully!!"
    body = "Hii Dr."+ doc_name +"  This notification is sent by Hospital_management system ,   Warm wishes To be a part of of this!!  Here is Your registration id:  "+ doc_id + "  and Your password is: "+doc_password
    send_email('simranhptu@gmail.com', doc_email, subject, body)









