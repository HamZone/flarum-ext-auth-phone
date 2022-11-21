import { settings } from '@fof-components';
import ExtensionPage from 'flarum/components/ExtensionPage';

const {
    items: { StringItem },
} = settings;

export default class SettingsPage extends ExtensionPage {
    oninit(vnode) {
        super.oninit(vnode);
        this.setting = this.setting.bind(this);
    }
    content() {
        return [
            <div className="SMSSettingsPage">
                <div className="container">
                    <div className="Form-group">
                        <StringItem
                            name={`flarum-ext-auth-phone.sms_ali_access_id`} //数据库存储字段
                            setting={this.setting}
                            {...{ ['required']: true }}
                        >
                            {app.translator.trans(`hamzone-auth-phone.admin.settings.api_sms_ali_access_id`)}
                        </StringItem>
                    </div>
                    <div className="Form-group">
                        <StringItem
                            name={`flarum-ext-auth-phone.sms_ali_access_sec`}
                            setting={this.setting}
                            {...{ ['required']: true }}
                        >
                            {app.translator.trans(`hamzone-auth-phone.admin.settings.api_sms_ali_access_sec`)}
                        </StringItem>
                    </div>
                    <div className="Form-group">
                        <StringItem
                            name={`flarum-ext-auth-phone.sms_ali_sign`}
                            setting={this.setting}
                            {...{ ['required']: true }}
                        >
                            {app.translator.trans(`hamzone-auth-phone.admin.settings.api_sms_ali_sign`)}
                        </StringItem>
                    </div>
                    <div className="Form-group">
                        <StringItem
                            name={`flarum-ext-auth-phone.sms_ali_template_code`}
                            setting={this.setting}
                            {...{ ['required']: true }}
                        >
                            {app.translator.trans(`hamzone-auth-phone.admin.settings.api_sms_ali_template_code`)}
                        </StringItem>
                    </div>
                    {this.submitButton()}
                </div>
            </div>
        ]
    }
}