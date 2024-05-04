import sqlite3

def generate_receipt(appointment_id):
    # Connect to the database
    conn = sqlite3.connect('login')
    cursor = conn.cursor()

    # Fetch appointment data from the database using the provided appointment ID
    cursor.execute("SELECT * FROM patient_offline_appointment WHERE id = ?", (id,))
    appointment = cursor.fetchone()

    if appointment:
        # Extract relevant information from the appointment data
        appointment_date = appointment[1]
        patient_name = appointment[2]
        doctor_name = appointment[3]
        # You can add more fields as needed

        # Generate the receipt content
        receipt_content = f"Appointment Receipt\n\n" \
                          f"Date: {appointment_date}\n" \
                          f"Patient: {patient_name}\n" \
                          f"Doctor: {doctor_name}\n"
        # Add more fields as needed

        # Print or save the receipt
        print(receipt_content)

    else:
        print("Appointment not found.")

    # Close the database connection
    conn.close()

# Example usage: generate_receipt(1) where 1 is the ID of the appointment you want to generate the receipt for
generate_receipt(1)  # Replace 1 with the actual appointment ID you want to generate the receipt for
