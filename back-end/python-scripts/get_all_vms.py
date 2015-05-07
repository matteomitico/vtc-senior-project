#!/usr/bin/env python

import json
import sys
import virtualbox

#Get all VMs for username 
# arg1 username 



vbox = virtualbox.VirtualBox()
machines = list()
for vm in vbox.machines:
	if vm.name[:len(sys.argv[1])] == sys.argv[1]:
		entry = {
			'name': vm.name,
			'description' : vm.description,
			'state' : str(vm.state)
			}
		machines.append(entry)

print json.dumps(machines)


