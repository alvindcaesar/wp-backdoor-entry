WP Backdoor Entry Script
======

I created this script to allow me to quickly login into my client's WordPress site after they have completely ~~fucked~~ messed things up. This will allows me to immediately create a new user with Administrator role and reset their details without having to fiddle with the database.

**_To use this script, you must have access to the web server itself (via FTP or SSH) because you need to upload this file and execute it through the browser_**.

**Possible use cases:**
- *You lose access to the site or forgot the credentials.*
- *The site is somehow hacked / being taken over by someone.*
- *You wanted to create a new admin user on the fly.*

Instructions:
------

1. Copy the `backdoor.php` file from this repository and upload it into your WordPress root directory. The default directory should be inside the `public_html` folder but if you install your WordPress site inside a sub-folder, then upload the file into the sub-folder accordingly.

2. Execute the script through your browser at `https://yourdomain.com/backdoor.php`. Replace `yourdomain.com` with your own domain name.

3. If it executes successfully, you should be redirected to WordPress login page and you will be able to login with the newly created admin user with the default credential => **username:** `administrator` | **password:** `password`.

4. **IMPORTANT**: Finally, delete the `backdoor.php` file. It's not a good idea to leave it inside the server because someone might exploit it.

**DISCLAIMER**: *I assumes no responsibility or liability for any errors or omissions in the content of this repository. The information contained in this repository is provided on an "as is" basis with no guarantees of completeness, accuracy, usefulness or timeliness.*