<?php if (!$this->user): ?>
    <form action="" method="POST">
        <table border="1">
            <tr>           
                <td>
                    Username
                </td>
                <td>
                    <input type="text" name="username"/>
                </td>
            </tr>
            <tr>           
                <td>
                    Password
                </td>
                <td>
                    <input type="password" name="password"/>
                </td>
            </tr>
            <tr>           
                <td>
                    Action
                </td>
                <td>
                    <input type="submit" name="login" value="Login"/>
                </td>
            </tr>
            <?php if ($this->error): ?> }
                <tr>           
                    <td>
                        Error
                    </td>
                    <td>
                        <?= $this->error; ?>
                    </td>
                </tr>
            <?php endif; ?>
        </table>
    </form>
<?php else : ?>
    <h1>Welcome <?= $this->user; ?></h1>
<?php endif; ?>

