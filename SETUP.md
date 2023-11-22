> **Git global setup**

```
git config --global user.name "Kévin Silliau"
git config --global user.email "zowlak.pro@gmail.com"
```

> **Create a new repository**

```
git clone https://gitlab.com/Zowlak/saedev.git
cd saedev
git switch -c main
touch README.md
git add README.md
git commit -m "add README"
git push -u origin main
```

> **Push an existing folder**

```
cd existing_folder
git init --initial-branch=main
git remote add origin https://gitlab.com/Zowlak/saedev.git
git add .
git commit -m "Initial commit"
git push -u origin main
```

> **Push an existing Git repository**

```
cd existing_repo
git remote rename origin old-origin
git remote add origin https://gitlab.com/Zowlak/saedev.git
git push -u origin --all
git push -u origin --tags
```
