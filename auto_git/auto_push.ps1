cd ..
while (1){
    git pull
    git add *
    git commit -m (Get-Date).ToString()
    git push
}
