import Modal from 'flarum/components/Modal';
import Button from 'flarum/components/Button';

export default class LinkModal extends Modal {
    className() {
        return `SMSAuthLinkModal Modal--small`;
    }

    title() {
        return app.translator.trans(`hamzone-auth-phone.forum.modals.link.title`);
    }

    content() {
        return (
            <div className="Modal-body">
                <div className="Form Form--centered">
                    <div className="Form-group">
                        <Button className={`Button LogInButton--SMSAuth`} loading={this.loading} disabled={this.loading}
                            path={`/auth/sms`} onclick={() => this.sendSMS()}>

                            {app.translator.trans(`hamzone-auth-phone.forum.buttons.send`)}
                        </Button>
                    </div>
                </div>
            </div>
        );
    }

    sendSMS() {
        // ${app.forum.attribute('apiUrl')}/${config.api.uri}/link
        app
        .request({
            url: app.forum.attribute('apiUrl') + "/auth/sms" + '/send',
            method: 'POST',
            errorHandler: this.onerror.bind(this),
        })
    }
}