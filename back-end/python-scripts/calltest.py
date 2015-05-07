#!/usr/bin/python

from subprocess import call
import json

used_ports = json.load(open("usedports.json"))
print used_ports
ps = {'http' : '10.0.2.15,8000' , 'webshell' : '10.0.2.15,12320', 'webmin' : '10.0.2.15,12321', 'ssh' : '10.0.2.15,22' } 
ports = {'http' : 8000, 'https' : 4000, 'ssh' : 22000, 'webshell' : 12000, 'webmin' : 13000} 

for pf in ps:
	print "checking: " + str(ports[pf])
	for i in range(ports[pf]+1, ports[pf] + 1000):
		if not i in used_ports:
			print i
			print pf + ",tcp,72.71.226.48," + str(i) + "," + ps[pf]
			call(["VBoxManage", 'modifyvm', "nodejs-13.0-i386", '--natpf1', pf + ",tcp,72.71.226.48," + str(i) + "," + ps[pf]])
			break

#d = {"one":"nodejs:ssh", "two":22}
#json.dump(d, open("usedports.json",'w'))


