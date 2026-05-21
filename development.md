## Session

This project will use PHP sessions to manage user authentication. The following session variables will be used:
- `$_SESSION['user_id']`: Stores the unique identifier of the logged-in user.
- `$_SESSION['username']`: Stores the username of the logged-in user.
- `$_SESSION['is_admin']`: Stores a boolean value indicating whether the user has administrative privileges (not part of MVP, may be implemented).
- `$_SESSION['csrf']`: Stores a unique token for CSRF protection.
- `$_SESSION['error']`: Stores error messages to be displayed to the user.
