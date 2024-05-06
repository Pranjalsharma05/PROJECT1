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
        
        print("PDF updated in database successfully!")
        
    except mysql.connector.Error as error:
        print("Failed to update PDF in database:", error)
        
    finally:
        # Close cursor and connection
        if cursor:
            cursor.close()
        if conn:
            conn.close()

# Example usage:
if len(sys.argv) != 3:
    print("Usage: python script.py <text> <username>")
    sys.exit(1)

text = sys.argv[1]
username = sys.argv[2]
pdf = text_to_pdf(text)
update_pdf_in_database(pdf, username)
