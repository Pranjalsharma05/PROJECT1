import matplotlib.pyplot as plt
import requests

# Fetch data from the server
response = requests.get('http://localhost/clone/PROJECT1/graph.php')
data = response.json()

# Process the data
labels = [item['doc_gender'] for item in data]
counts = [item['count'] for item in data]

# Create a pie chart
plt.figure(figsize=(8, 8))
plt.pie(counts, labels=labels, autopct='%1.1f%%', startangle=140, colors=['skyblue', 'lightcoral'])
plt.title('Doctor Gender Distribution')
plt.axis('equal')  # Equal aspect ratio ensures that pie is drawn as a circle.
plt.show()
