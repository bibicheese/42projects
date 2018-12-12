#!/bin/sh 

touch 1.txt
touch 2.txt
ldapwhoami -Q  > 2.txt
cut -d : -f2 2.txt >> 1.txt
cat 1.txt
rm 1.txt 2.txt 