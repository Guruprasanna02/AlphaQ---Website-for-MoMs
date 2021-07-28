#!/bin/bash

#Downloading attendance.log
echo "Wait for a while..." #Displaying message in terminal for user
wget  -o /dev/null https://inductions.delta.nitt.edu/sysad-task-1-attendance.log

cut -f 2,3,4 -d '-' sysad-task-1-attendance.log | cut -f 1 -d ',' | uniq > tempDates.txt #A temporary file(deleted at the end of this script) to get meetdates and create an array

#Getting all meetdates in an array
meetDates=()
while read p
do
	meetDates+=($p)
done < tempDates.txt
exceed=${#meetDates[@]}
exceed=$[exceed-1]

#Generates an array with all last joined user with date (between given paramters)
lastJoined=()
getMom(){
	local date="$1"
	x=$(grep $date sysad-task-1-attendance.log | cut -f 1 -d '-' | tac | sed 's/_10/_00/g' | grep '_0' | head -1 | tr -d ' ')
	if [ -z $x ]
	then
		lastJoined+=($(echo "n-$date" ))
	else
		case "_00" in
			$x )
				x=$(echo $x | sed 's/_00/_10/g') ;;
		esac
		lastJoined+=($(echo $x-$date))
	fi
}

if expr "$1" ">=" "${meetDates[0]}" > /dev/null && expr "$2" "<=" "${meetDates[$exceed]}" > /dev/null
then
		for (( z=0; z<$exceed; z++ ))
		do
				if expr "${meetDates[$z]}" ">=" "$1" > /dev/null
				then
						x=$z
						break
				fi
		done
		for (( z=0; z<$exceed; z++ ))
		do
				if expr "${meetDates[$z]}" ">=" "$2" > /dev/null
				then
						if expr "${meetDates[$z]}" "=" "$2" > /dev/null
						then
								y=$z
								break
						else
								y=$[z-1]
								break
						fi
				fi
		done
		lim=$[$y+1]
		for (( z=$x; z<$lim; z++ ))
		do
				getMom ${meetDates[$z]}
		done
		echo Table Updated sucessfully
else
		echo Sorry, wrong input.
fi

#Writing the MoM of each date with username into SQL database
python3.9 /root/initialize.py 2> /dev/null
for i in ${lastJoined[@]}
do
	x=$(echo $i | cut -f 1 -d '-')
	y=$(echo $i | cut -f 2,3,4 -d '-')
	if [ "$x" = "n" ]
	then
		python3.9 /root/tableUpdate.py "No second year in this meet" $y
	else
		m=$(cat /home/$x/$y"_mom" 2> /dev/null)
		python3.9 /root/tableUpdate.py $x $y $m 2> /dev/null
	fi
done

rm tempDates.txt
rm sysad-task-1-attendance.log
