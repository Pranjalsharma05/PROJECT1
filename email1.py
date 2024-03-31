
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
    username = sys.argv[1]
    subject = "Thank you for your registration"
    body = "Thanking for your registration,This notification is sent by Hospital_management system to "+username
    send_email('simranhptu@gmail.com', username, subject, body)











# server = smtplib.SMTP("smtp.gmail.com", 587)
# server.starttls()

# server.login('ujbaljariyal@gmail.com',"tgbhscqnbxrtvljt")

# server.sendmail('ujbaljariyal@gmail.com','pranjal202522@gmail.com',"mail from python to ps")

# print("Email has been sent to")