import mysql.connector
from fpdf import FPDF
import sys

def text_to_pdf(text):
    pdf = FPDF()
    pdf.add_page()
    pdf.set_font("Arial", size=12)
    pdf.multi_cell(0, 10, txt=text)
    return pdf

def update_pdf_in_database(pdf, username):
    try:
        print("Connecting to the database...")
        # Establish database connection
        conn = mysql.connector.connect(
            host="localhost",
            user="root",
            password="",
            database="login"
        )
        

        
        # Create a cursor object
        cursor = conn.cursor()
        
        # Output PDF to memory
        pdf_output = pdf.output(dest='S').encode('latin1')
        

        
        # Update PDF in database for the specified username
        cursor.execute("UPDATE patient_offline_appointment SET pdf_data = %s WHERE username = %s", (pdf_output, username))
        
       
        
        # Commit changes
        conn.commit()
        
    except mysql.connector.Error as error:
        print("Failed to update PDF in database:", error)
        
    finally:
        # Close cursor and connection
        if cursor:
            cursor.close()
        if conn:
            conn.close()

# Example usage:
if len(sys.argv) != 7:
    print("Usage: python script.py <doctor_name> <username> <date> <diagnosis> <treatment> <medicine>")
    sys.exit(1)

doctor_name = sys.argv[1]
username = sys.argv[2]
date = sys.argv[3]
diagnosis = sys.argv[4]
treatment = sys.argv[5]
medicine = sys.argv[6]

text = f"PRESCRIBED BY Dr. {doctor_name}\n\nTO PATIENT: {username}\n\n ON DATE: {date}\n\n DIAGNOSIS: {diagnosis}\n\n TREATMENT RECOMMENDED BY DOCTOR: {treatment}\n\n MEDICINE PRESCRIBED: {medicine}\n"
pdf = text_to_pdf(text)
update_pdf_in_database(pdf, username)
