from reportlab.lib.pagesizes import letter
from reportlab.pdfgen import canvas
from sqlalchemy import create_engine
from sqlalchemy.orm import sessionmaker
from your_database_model import YourTableModel  # Import your SQLAlchemy model here

# Connect to the database
username = 'root' 
password = ''
hostname = 'localhost'
port = '3306'
database_name = 'login'

connection_string = f'mysql://{username}:{password}@{hostname}:{port}/{database_name}'
engine = create_engine(connection_string)
Session = sessionmaker(bind=engine)
session = Session()

# Fetch text from the database
result = session.query(YourTableModel).first()  # Example query, adjust as needed
text_from_database = result.text_field  # Assuming 'text_field' is the field containing the text

# Create a PDF document
pdf_file_path = 'output.pdf'
c = canvas.Canvas(pdf_file_path, pagesize=letter)

# Insert text into the PDF
text_x = 100  # Adjust these coordinates as needed
text_y = 700
c.drawString(text_x, text_y, text_from_database)

# Save the PDF
c.save()

print(f"PDF generated successfully: {pdf_file_path}")
