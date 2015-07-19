#This file fetches the count of missingperson falling under certain age group 
#We dump the data in statisticsage.json file
import json
import requests
from py2neo import neo4j,cypher
headers={'content-type':'application/json'}
url='http://MissingPerson:WefjajoR8aznY26vtkR6@missingperson.sb02.stations.graphenedb.com:24789/db/data/cypher'
g=neo4j.GraphDatabaseService(url)
mp=[];
cp=['0-20','21-40','41-60','60 above']
querry={"query":"match (n:MissingPerson) where n.age>={n1} and n.age<={n2} return count(n)","params":{"n1":'0',"n2":'20'}}
d1=requests.post(url,data=json.dumps(querry),headers=headers)
mp.append(d1.json()['data'][0][0])
querry={"query":"match (n:MissingPerson) where n.age>={n1} and n.age<={n2} return count(n)","params":{"n1":'21',"n2":'40'}}
d1=requests.post(url,data=json.dumps(querry),headers=headers)
mp.append(d1.json()['data'][0][0])
querry={"query":"match (n:MissingPerson) where n.age>={n1} and n.age<={n2} return count(n)","params":{"n1":'41',"n2":'60'}}
d1=requests.post(url,data=json.dumps(querry),headers=headers)
mp.append(d1.json()['data'][0][0])
querry={"query":"match (n:MissingPerson) where n.age>={n1}  return count(n)","params":{"n1":'60'}}
d1=requests.post(url,data=json.dumps(querry),headers=headers)
mp.append(d1.json()['data'][0][0])
payload=dict(zip(cp,mp));
with open("statisticsage.json","w") as outfile:
        json.dump(payload,outfile)

