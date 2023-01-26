`yii migrate/create drop_username_column_from_user_table --fields="username:string:notNull:unique"`
`./yii migrate`

`./yii message/config-template backend/messages/config.php`
`./yii message backend/messages/config.php`

`./yii migrate/create init_rbac`
`./yii migrate`

Copy `console/rbac` to `backend/rbac`

`./yii migrate/create create_ticket_table`
`./yii migrate`
