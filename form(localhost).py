#/usr/bin/env python
import json
import simplejson as js
import requests
from py2neo import neo4j,cypher
headers={'content-type':'application/json'}
url='http://localhost:7474/db/data/node'

fp=open('data_en.json').read()
l=json.loads(fp)
g=neo4j.GraphDatabaseService()
mdata=l[0]
mr=requests.post(url,data=json.dumps(mdata),headers=headers)
mk=mr.json()['self'];
mt=mk+'/labels'
mdata="MissingPerson"
mr=requests.post(mt,data=json.dumps(mdata),headers=headers)
mj=cypher.execute(g,"match (n:State) where n.name='"+l[0]['state']+"' return id(n)")[0][0][0]
#print j;
mj='http://localhost:7474/db/data/node/'+str(mj)
mj=mj+'/relationships'
mdi={"to":mk,"type":"missing"}
mr=requests.post(mj,data=json.dumps(mdi),headers=headers)
print mr.json();

cdata=l[1]
cr=requests.post(url,data=json.dumps(cdata),headers=headers)
ck=cr.json()['self'];
ct=ck+'/labels'
cdata="ContactPerson"
cr=requests.post(ct,data=json.dumps(cdata),headers=headers)
cj=cypher.execute(g,"match (n:State) where n.name='"+l[1]['state']+"' return id(n)")[0][0][0]
#print j;
cj='http://localhost:7474/db/data/node/'+str(cj)
cj=cj+'/relationships'
cdi={"to":ck,"type":"contact"}
cr=requests.post(cj,data=json.dumps(cdi),headers=headers)
print cr.json();
	



