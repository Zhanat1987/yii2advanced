<h1>
    Аутентификация
</h1>
<hr />
<p>
    Аутентификация является актом проверки, кто является пользователем, и является основой
    процесса входа в систему. Как правило, проверка подлинности использует комбинацию
    идентификатора - имя пользователя или адрес электронной почты - и пароль.
    Пользователь отправляет эти значения через форму, и приложение сравнивает
    представленную информацию с ранее сохраненной (например, при регистрации).
</p>
<p>
    В Yii весь этот процесс выполняется в полуавтоматическом режиме, оставляя разработчику
    только реализовать [[yii\web\IdentityInterface]], самый важный класс в системе
    аутентификации. Как правило, реализация IdentityInterface осуществляется с использованием
    модели пользователя (User).
</p>
<p>
    Вы можете найти полнофункциональный пример аутентификации в расширенном шаблоне приложения.
    Ниже, только методы интерфейса перечислены:<br />
    <?php
    highlight_string("<?php
class User extends ActiveRecord implements IdentityInterface
{
    // ...

    /**
     * Finds an identity by the given ID.
     *
     * @param string|integer \$id the ID to be looked for
     * @return IdentityInterface|null the identity object that matches the given ID.
     */
    public static function findIdentity(\$id)
    {
        return static::find(\$id);
    }

    /**
     * @return int|string current user ID
     */
    public function getId()
    {
        return \$this->id;
    }

    /**
     * @return string current user auth key
     */
    public function getAuthKey()
    {
        return \$this->auth_key;
    }

    /**
     * @param string \$authKey
     * @return boolean if auth key is valid for current user
     */
    public function validateAuthKey(\$authKey)
    {
        return \$this->getAuthKey() === \$authKey;
    }
}
?>");
    ?>
</p>
<p>
    Два из описанных выше методов просты: findIdentity снабжен значением идентификатора и
    возвращает экземпляр модели, связанный с этим идентификатором.
    Метод GetId возвращает сам идентификатор. Два других метода - getAuthKey и validateAuthKey -
    используются для обеспечения дополнительной безопасности в "remember me" cookie.
    Метод getAuthKey должен вернуть строку, которая является уникальной для каждого пользователя.
    Вы можете надежно создавать уникальную строку, используя Security::generateRandomKey().
    Это хорошая идея, чтобы также сохранить это как часть записи пользователя:<br />
    <?php
    highlight_string("<?php
public function beforeSave(\$insert)
{
    if (parent::beforeSave(\$insert)) {
        if (\$this->isNewRecord) {
            \$this->auth_key = Security::generateRandomKey();
        }
        return true;
    }
    return false;
}
?>");
    ?>
</p>
<p>
    Метод validateAuthKey просто сравнивает переменную $authKey,
    переданную в качестве параметра (извлекаются из cookie),
    со значением извлекаемым из базы данных.
</p>