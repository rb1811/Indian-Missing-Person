#This file fetches the male to female ration state wise  
#We dump the [state,malecount,femalecount] in this format in statsstatesexoutput.json file 
import json
import requests
from py2neo import neo4j,cypher
headers={'content-type':'application/json'}
url='http://MissingPerson:WefjajoR8aznY26vtkR6@missingperson.sb02.stations.graphenedb.com:24789/db/data/cypher'
g=neo4j.GraphDatabaseService(url)
mp=[]
st=['Andhra Pradesh','Arunachal Pradesh','Assam','Bihar','Chhattisgarh','Goa','Gujarat','Haryana','Himachal Pradesh','Jammu and Kashmir','Jharkhand','Karnataka','Kerala','Madhya Pradesh','Maharashtra','Manipur','Meghalaya','Mizoram','Nagaland','Orissa','Punjab','Rajasthan','Sikkim','Tamil Nadu','Telangana','Tripura','Uttar Pradesh','Uttarakhand','West Bengal']
for i in st:
	ans=[]
	querry={"query":"match (n:States {name:{n1}})-[]->(m:MissingPerson) return count(m)","params":{"n1":i}}
	d1=requests.post(url,data=json.dumps(querry),headers=headers)	
	totalcount=d1.json()['data'][0][0]
	querry={"query":"MATCH (m:States {name:{n1}})-[missing]->(n:MissingPerson) where n.gender={n2} return count(n)","params":{"n1":i,"n2":'M'}}
	d1=requests.post(url,data=json.dumps(querry),headers=headers)
	malecount=d1.json()['data'][0][0]
	femalecount=totalcount-malecount
	ans.append(i)
	ans.append(malecount)
	ans.append(femalecount)
	mp.append(ans)
with open("statsstatesexoutput.json","w") as outfile:
        json.dump(mp,outfile)

