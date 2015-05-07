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
print "hii"
gateway = '192.168.1.22'
vms_repo_path = expanduser("~") + '/cluster/VMs'
vm_repo = { 
	'nodejs' : {
		'folder' : '/nodejs/nodejs-13.0-i386/', 
		'file' : 'nodejs.ovf'  , 
		'vm_name' : 'nodejs-13.0-i386', 
		'ports': {
			'http' 		: {'rule': '10.0.2.15,8000' , 'note': 'http"//{{{the-gatway}}}' },
			'https' 	: {'rule': '10.0.2.15,443'  , 'note': 'https"//{{{the-gatway}}}' },
			'webshell' 	: {'rule': '10.0.2.15,12320', 'note': 'https"//{{{the-gatway}}}' },
			'webmin' 	: {'rule': '10.0.2.15,12321', 'note': 'https"//{{{the-gatway}}}' },
			'ssh'		: {'rule': '10.0.2.15,22'   , 'note': 'root@{{{the-gatway}}} (port: )'}
		},
		'notes' : [
			'admin:root',
			'password:root'
		]
	},
	'postgresql' : {
		'folder' : '/postgresql/postgresql-i386/', 
		'file' : 'postgresql-i386.ovf'  , 
		'vm_name' : 'postgres', 
		'ports': {
			'PHPPgAdmin' 	: {'rule': '10.0.2.15,443',  'note': 'https://{{{the-gatway}}' } , 
			'webshell'		: {'rule': '10.0.2.15,12320', 'note': 'https://{{{the-gatway}}}' } , 
			'webmin' 		: {'rule': '10.0.2.15,12321', 'note': 'https://{{the-gatway}}}' } , 
			'ssh' 			: {'rule': '10.0.2.15,22',    'note': 'root@{{{the-gatway}}} (port: )'} 
		},
		'notes' : [
			'admin:root',
			'password:root',
			'postgresql password:postgresroot',
			'PostgreSQL: psql -U postgres -h 10.0.2.15'
		]
	}
}
port_ranges = {'http' : 8000,
		'https' : 4000, 
		'ssh' : 22000, 
		'webshell' : 12000, 
		'webmin' : 13000,
		'PHPPgAdmin': 4000
		} 
 
vm_type = sys.argv[1]
vm_name = sys.argv[2]
vbox = virtualbox.VirtualBox()
 
# Create new IAppliance and read the exported machine
# called 'vmName'.
print vms_repo_path
path = os.path.normpath(vms_repo_path + vm_repo[vm_type]['folder'] + vm_repo[vm_type]['file'])
print path
appliance = vbox.create_appliance()
appliance.read(path)
 
# Extract the IVirtualSystemDescription object 
# for 'ubuntu' and set its name to 'foobar' and cpu '2'.
#desc = appliance.interpret()  # for some reason this returns empty so I go with find_description(name of the vm when it is imported)
#pprint (dir(desc))
desc = appliance.find_description(vm_repo[vm_type]['vm_name'])
pprint (dir(desc))
desc.set_name(vm_name)
