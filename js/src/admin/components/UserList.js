import { extend } from 'flarum/common/extend';
import UserListPage from 'flarum/admin/components/UserListPage';

//https://api.docs.flarum.org/js/v1.1.0/class/src/admin/components/userlistpage.tsx~userlistpage#instance-method-columns
//https://github.dev/FriendsOfFlarum/pages
//vendor/core/js/src/admin/UserListPage
export default function () {
    extend(UserListPage.prototype, 'columns', (columns) => {
        columns.add('phoneStatus', {
        name:"Phone",
        content:(user) => {
          if(user.data.attributes.SMSAuth.isAuth){
            return <div>Y</div>;
          }else{
            return <div></div>;
          }
        },
      });
    });
  }
  
