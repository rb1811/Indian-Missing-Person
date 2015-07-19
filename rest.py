#/usr/bin/env python
import json
#import simplejson as js
import requests
from py2neo import neo4j,cypher
headers={'content-type':'application/json'}
url='http://MissingPerson:WefjajoR8aznY26vtkR6@missingperson.sb02.stations.graphenedb.com:24789/db/data/node'
url1='http://MissingPerson:WefjajoR8aznY26vtkR6@missingperson.sb02.stations.graphenedb.com:24789/db/data/'

fp=open('data_en.json').read()
l=json.loads(fp)
g=neo4j.GraphDatabaseService(url1)
mdata=l[0]
mr=requests.post(url,data=json.dumps(mdata),headers=headers)
idd=str(mr.json()['self'])[-3:]
if(list(idd)[0]=='/'):
	labelurl=url+idd+'/labels'
	nodeurl=url+idd;
else:
	labelurl=url+'/'+idd+'/labels'
	nodeurl=url+'/'+idd;
print "misingperson urlssss-->>>"
print labelurl;
print nodeurl;
mdata="MissingPerson"
mr=requests.post(labelurl,data=json.dumps(mdata),headers=headers)
mj=cypher.execute(g,"match (n:States) where n.name='"+l[0]['state']+"' return id(n)")[0][0][0]
mj="http://MissingPerson:WefjajoR8aznY26vtkR6@missingperson.sb02.stations.graphenedb.com:24789/db/data/node/"+str(mj)
mj=mj+'/relationships'
mdi={"to":nodeurl,"type":"missing"}
mr=requests.post(mj,data=json.dumps(mdi),headers=headers)
print mr.json();
print "missing person finished--->>>"

cdata=l[1]
cr=requests.post(url,data=json.dumps(cdata),headers=headers)
idd=str(cr.json()['self'])[-3:]
if(list(idd)[0]=='/'):
	labelurl=url+idd+'/labels'
	nodeurl=url+idd;
else:
	labelurl=url+'/'+idd+'/labels'
	nodeurl=url+'/'+idd;
print "contactperson urlss" 
print labelurl;
print nodeurl;
cdata="ContactPerson"
cr=requests.post(labelurl,data=json.dumps(cdata),headers=headers)
cj=cypher.execute(g,"match (n:States) where n.name='"+l[1]['state']+"' return id(n)")[0][0][0]
cj='http://MissingPerson:WefjajoR8aznY26vtkR6@missingperson.sb02.stations.graphenedb.com:24789/db/data/node/'+str(cj)
cj=cj+'/relationships'
cdi={"to":nodeurl,"type":"contact"}
cr=requests.post(cj,data=json.dumps(cdi),headers=headers)
print cr.json();
print "contactperson finished--->>>"



