#!/usr/bin/python

import json
d = {"one":"1", "two":2}
json.dump(d, open("text.txt",'w'))

d2 = json.load(open("text.txt"))
print d2

