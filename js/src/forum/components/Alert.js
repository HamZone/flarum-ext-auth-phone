
import app from 'flarum/forum/app';

let temporarilyHidden = false;

export default class UpdateAlert {
  shouldShowAlert() {
    if (temporarilyHidden) {
      return false;
    }

    const user = app.session.user;

    return user && true;
  }

  view(){
    if (!this.shouldShowAlert()) {
      return m('div');
    }

    return m(
        '.Alert.Alert-info',
        m('.container', [
          m(
            'span.Alert-body', "在您验证手机号码之前，我们临时限制了您账户的操作权限。"
          ),
          m('ul.Alert-controls', ""),
        ])
    );
  }
    
}
