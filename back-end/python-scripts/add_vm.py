#!/usr/bin/env python

import json
import sys, os
import virtualbox
from os.path import expanduser
from pprint import pprint
from subprocess import call

#create virtual machine from the repository 
# arg1 = vmType
# arg2 = vmName
# return 1|0 success or failure

# list of all VMs

gateway = '155.42.97.220'
#gateway = '155.42.13.162'
vms_repo_path = expanduser("~") + '/cluster/VMs'
vm_repo = { 
	'nodejs' : {
		'folder' : '/nodejs/nodejs-13.0-i386/', 
		'file' : 'nodejs.ovf'  , 
		'vm_name' : 'nodejs-13.0-i386', 
		'ports': {
			'http' 		: {'rule': '10.0.2.15,8000' , 'note': 'http://{{the-gatway}}' },
			'https' 	: {'rule': '10.0.2.15,443'  , 'note': 'https://{{the-gatway}}' },
			'webshell' 	: {'rule': '10.0.2.15,12320', 'note': 'https://{{the-gatway}}' },
			'webmin' 	: {'rule': '10.0.2.15,12321', 'note': 'https://{{the-gatway}}' },
			'ssh'		: {'rule': '10.0.2.15,22'   , 'note': 'root@{{the-gatway}} port'}
		},
		'notes' : [
			'Webmin, SSH: username:root',
			'default password:root (remember to change!)'
		]
	},
	'postgresql' : {
		'folder' : '/postgresql/postgresql-i386/', 
		'file' : 'postgresql-i386.ovf'  , 
		'vm_name' : 'postgres', 
		'ports': {
			'PHPPgAdmin' 	: {'rule': '10.0.2.15,443',  'note': 'https://{{the-gatway}}' } , 
			'webshell'		: {'rule': '10.0.2.15,12320', 'note': 'https://{{the-gatway}}' } , 
			'webmin' 		: {'rule': '10.0.2.15,12321', 'note': 'https://{{the-gatway}}' } , 
			'ssh' 			: {'rule': '10.0.2.15,22',    'note': 'root@{{the-gatway}} port'} 
		},
		'notes' : [
			'Webmin, SSH: username:root, password:root(remember to change!)',
			'postgresql, phppgadmin: username:postgres, password:postgresroot(remember to change!)',
			'PostgreSQL: psql -U postgres -h 10.0.2.15'
		]
	},
	'lamp' : {
		'folder' : '/lamp/lamp-13.0-i386/', 
		'file' : 'lamp-13.0.ovf'  , 
		'vm_name' : 'lamp-13.0', 
		'ports': {
			'http' 		: {'rule': '10.0.2.15,80' , 'note': 'http://{{the-gatway}}' },
			'https' 	: {'rule': '10.0.2.15,443'  , 'note': 'https://{{the-gatway}}' },
			'webshell' 	: {'rule': '10.0.2.15,12320', 'note': 'https://{{the-gatway}}' },
			'webmin' 	: {'rule': '10.0.2.15,12321', 'note': 'https://{{the-gatway}}' },
			'ssh'		: {'rule': '10.0.2.15,22'   , 'note': 'root@{{the-gatway}} port'},
			'PHPMyAdmin' 	: {'rule': '10.0.2.15,12322',  'note': 'https://{{the-gatway}}' } ,
		},
		'notes' : [
			'Webmin, SSH: username:root, password:root(remember to change!)',
			'MySQL, phpMyAdmin: username:root, password:mysql(remember to change!)'
		]
	},
	'rails' : {
		'folder' : '/rails/lamp-13.0-i386/', 
		'file' : 'lamp-13.0.ovf'  , 
		'vm_name' : 'lamp-13.0', 
		'ports': {
			'http' 		: {'rule': '10.0.2.15,80' , 'note': 'http://{{the-gatway}}' },
			'https' 	: {'rule': '10.0.2.15,443'  , 'note': 'https://{{the-gatway}}' },
			'webshell' 	: {'rule': '10.0.2.15,12320', 'note': 'https://{{the-gatway}}' },
			'webmin' 	: {'rule': '10.0.2.15,12321', 'note': 'https://{{the-gatway}}' },
			'ssh'		: {'rule': '10.0.2.15,22'   , 'note': 'root@{{the-gatway}} port'},
			'PHPMyAdmin' 	: {'rule': '10.0.2.15,12322',  'note': 'https://{{the-gatway}}' } ,
		},
		'notes' : [
			'Webmin, SSH: username:root, password:root(remember to change!)',
			'MySQL: username:root, password:mysql(remember to change!)'
		]
	}
}
port_ranges = {'http' : 8000,
		'https' : 4000, 
		'ssh' : 22000, 
		'webshell' : 12000, 
		'webmin' : 13000,
		'PHPPgAdmin': 14000,
		'PHPMyAdmin': 15000,
		} 
 
vm_type = sys.argv[1]
vm_name = sys.argv[2]
vbox = virtualbox.VirtualBox()
notes = vm_repo[vm_type]['notes']
 
# Create new IAppliance and read the exported machine
# called 'vmName'.
path = os.path.normpath(vms_repo_path + vm_repo[vm_type]['folder'] + vm_repo[vm_type]['file'])
#print path

#adding port forwardings
if os.stat("usedports.json").st_size == 0 : 
	used_ports = {}
else:
	used_ports = json.load(open("usedports.json"))

ports_to_forward = []	
for port_forw_rule in vm_repo[vm_type]['ports']:
	#print "checking: " + port_forw_rule + str(port_ranges[port_forw_rule])
	for the_port in range(port_ranges[port_forw_rule]+1, port_ranges[port_forw_rule] + 1000):
		#print the_port
		#print used_ports
		if not str(the_port) in used_ports:
			#print the_port
			#print port_forw_rule + ",tcp," + gateway + "," + str(the_port) + "," + vm_repo[vm_type]['ports'][port_forw_rule]
			
			#print 'making notes'
			note = port_forw_rule + ": " + vm_repo[vm_type]['ports'][port_forw_rule]['note'] + ":" + str(the_port)
			#print note
			note = note.replace("{{the-gatway}}", gateway);
			#print note
			notes.append(note)
			#pprint (["VBoxManage", 'modifyvm', vm_name , '--natpf1', port_forw_rule + ",tcp," + gateway + "," + str(the_port) + "," + vm_repo[vm_type]['ports'][port_forw_rule]['rule']])
			
			ports_to_forward.append(["VBoxManage", 'modifyvm', vm_name , '--natpf1', port_forw_rule + ",tcp," + gateway + "," + str(the_port) + "," + vm_repo[vm_type]['ports'][port_forw_rule]['rule'] ])
			#call(["VBoxManage", 'modifyvm', vm_name , '--natpf1', port_forw_rule + ",tcp," + gateway + "," + str(the_port) + "," + vm_repo[vm_type]['ports'][port_forw_rule]['rule'] ])
			#print 'done'
			used_ports[the_port] = vm_name + ":" + vm_type
			break
			
json.dump(used_ports, open("usedports.json",'w'))			
			
appliance = vbox.create_appliance()
appliance.read(path)
 
# Extract the IVirtualSystemDescription object 
# for 'ubuntu' and set its name to 'foobar' and cpu '2'.
#desc = appliance.interpret()  # for some reason this returns empty so I go with find_description(name of the vm when it is imported)
#pprint (dir(desc))
desc = appliance.find_description(vm_repo[vm_type]['vm_name'])
#pprint (dir(desc))
desc.set_name(vm_name)

my_desc = '';
for n in notes:
	my_desc += n + ',\n'
	#print my_desc
desc.set_final_value(9, my_desc )

try:
	# perform import
	progress = appliance.import_machines()
	progress.wait_for_completion()
	new_vm = vbox.find_machine(vm_name)
	
	for pf in ports_to_forward:
		call(pf)
	
	result = {'status' : 1, 'note' : notes}
	pprint (result) 
except:
	pprint (vars(sys.exc_info()[0]))
	#print 0




