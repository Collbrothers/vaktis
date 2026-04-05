# vaktis

vaktis is a simple web application that allows users to log in and post a listing for their dogs, that other users can view and apply if interested.

## Setup
1. Open a terminal and clone the repository:
   ```bash
   git clone https://github.com/Collbrothers/vaktis.git
   ```
   
    This will create a new directory called `vaktis` in your current location with the project files. Default location when opening a terminal is usually your home directory (e.g. `C:\Users\aron.kyleback\` for Windows), so you can find the directory there.
2. Open the project in vscode.
3. Set up a local web server & database with Laragon or XAMPP.
4. Copy `.env.example` to `.env` and fill in the required values. 
5. Import sql/schema.sql into your database, ask me if you need help with this step.
6. Done.

## Git Workflow

This goes over how you can contribute via the terminal since I am not familiar with vscode's git integration, but with these instructions you should be able to figure it out in vscode.

1. Create a new branch for your feature or bug fix, do not push to main directly:
   ```bash
   git checkout -b feature/your-feature-name
   ```
2. Make your changes and commit them with a **descriptive** message:
   ```bash
    git add --all
    git commit -m "feature: added xyz functionality"
    ```
3. Push your branch to the remote repository:
    ```bash
    git push origin feature/your-feature-name
    ```
4. Create a pull request on GitHub and tell the others about it, we will review it and merge it if everything looks good.
5. Once your pull request is approved and merged, you can delete your branch:
   ```bash
    git checkout main
    git pull origin main
    git branch -d feature/your-feature-name
    ```
   

**Once again: Do NOT push to main directly, create a new branch & make a pr.** 


## Folder structure

- `vaktis/`
  - `includes/` - Files that are reused across the project, such as header, authentication and more.
  - `pages/` - Contains the actual PHP pages, such as login.php etc.
  - `public/` - CSS, images & potential JavaScript files goes here.
  - `sql/` - Contains the schema.sql file.
  - `index.php` - The main entry point of the application.
  - `.env.example` - See below for more info.
  - `LICENSE` - The license file for the project, in our case not really needed, but I added a MIT license. For more information about licenses ask me.
  - `.gitignore` - Specifies what files and or directories should be ignored by git.
  - `readme.md` - This file, a Markdown file that contains the instructions you are reading right now. Once again if you want more information ask me.
  - `docker-compose.yml` - Ignore this, it's for my local development environment. But if you want to use it or learn, ask  me :)
  - `Dockerfile` - Same as above.
  - `development.md` - A Markdown file with more technical information about the project.

### .env.example file

The `.env.example` file acts as a template for a `.env` file, which is used to store environment variables for the project (database credentials in our case). You simply copy the contents of `.env.example` into `.env` and fill in the values. The `.env` file is ignored by git.

The use of environment variables may be removed in the future depending on the configuration of the web server we are deploying to at the end. I will ask about this and make the necessary changes if needed.