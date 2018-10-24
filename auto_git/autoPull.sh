cd ..
while true
do
  val=$(git pull)
  if [ "$val" != "Already up-to-date." ]
  then
    /etc/init.d/apache2 reload
  fi
done
