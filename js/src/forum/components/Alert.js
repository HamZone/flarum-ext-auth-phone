
import app from 'flarum/forum/app';

let temporarilyHidden = false;

export default class UpdateAlert {

    view(){
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
