#This file fetches the count of missingperson falling under certain age group states wise 
#We dump the data in statsageoutput.json file
import json
import requests
import unicodedata
from py2neo import neo4j,cypher
headers={'content-type':'application/json'}
url='http://MissingPerson:WefjajoR8aznY26vtkR6@missingperson.sb02.stations.graphenedb.com:24789/db/data/cypher'
g=neo4j.GraphDatabaseService(url)
ans=[];
st=['Andhra Pradesh','Arunachal Pradesh','Assam','Bihar','Chhattisgarh','Goa','Gujarat','Haryana','Himachal Pradesh','Jammu and Kashmir','Jharkhand','Karnataka','Kerala','Madhya Pradesh','Maharashtra','Manipur','Meghalaya','Mizoram','Nagaland','Orissa','Punjab','Rajasthan','Sikkim','Tamil Nadu','Telangana','Tripura','Uttar Pradesh','Uttarakhand','West Bengal']
for i in st:	
	mp=[];
	querry={"query":"match (m:States {name:{n0}})-[:missing]->(n:MissingPerson) return n.city","params":{"n0":i}}
	d1=requests.post(url,data=json.dumps(querry),headers=headers)
	for j in d1.json()['data']:
		str=''.join(j)
		mp.append(unicodedata.normalize('NFKD', str).encode('ascii','ignore'))	
	ans.append(dict(zip([i],[mp])))	
with open("statescitiesoutput.json","w") as outfile:
        json.dump(ans,outfile)

