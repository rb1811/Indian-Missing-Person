#This file gives the count of the MissingPerson for every state
#We dump the payload in statistics.json file 
import json
import requests
from py2neo import neo4j,cypher
headers={'content-type':'application/json'}
url='http://MissingPerson:WefjajoR8aznY26vtkR6@missingperson.sb02.stations.graphenedb.com:24789/db/data/cypher'
g=neo4j.GraphDatabaseService(url)
st=['Andhra Pradesh','Arunachal Pradesh','Assam','Bihar','Chhattisgarh','Goa','Gujarat','Haryana','Himachal Pradesh','Jammu and Kashmir','Jharkhand','Karnataka','Kerala','Madhya Pradesh','Maharashtra','Manipur','Meghalaya','Mizoram','Nagaland','Orissa','Punjab','Rajasthan','Sikkim','Tamil Nadu','Telangana','Tripura','Uttar Pradesh','Uttarakhand','West Bengal']
count=[]
for i in st:
	querry={"query":"match (n:States {name:{n1}})-[]->(m:MissingPerson) return count(m)","params":{"n1":i}}
	d1=requests.post(url,data=json.dumps(querry),headers=headers)
	count.append(d1.json()['data'][0][0]);
payload=dict(zip(st,count))
with open("statistics.json","w") as outfile:
	json.dump(payload,outfile)
