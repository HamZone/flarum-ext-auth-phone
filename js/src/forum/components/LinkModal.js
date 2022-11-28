import Modal from 'flarum/components/Modal';
import Button from 'flarum/components/Button';

export default class LinkModal extends Modal {
    oninit(vnode) {
        super.oninit(vnode);
    
        app.store.all('fof-terms-policies').forEach((policy) => {
          this[policy.form_key()] = false;
        });
    }

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
                        <input class="FormControl bottom" 
                            className="phone" 
                            placeholder={app.translator.trans(`hamzone-auth-phone.forum.modals.link.phone`)}
                            oninput={e => this.phone = e.target.value}
                            disabled={this.inputDisabled}
                        >
                        </input>

                        <input class="FormControl bottom" 
                            className="code" 
                            placeholder={app.translator.trans(`hamzone-auth-phone.forum.modals.link.code`)}
                            oninput={e => this.code = e.target.value}
                            style={{display:this.display ? "block" : "none"}}
                        ></input>

                        <Button className={`Button LogInButton--SMSAuth`} loading={this.loading} disabled={this.loading}
                            onclick={() => this.sendSMS(this.phone)} style={{display:this.displaySend}}>
                            {app.translator.trans(`hamzone-auth-phone.forum.buttons.send`)}
                        </Button>

                        <Button className={`Button LogInButton--SMSAuth`} style={{display:this.display ? "block" : "none"}}
                            onclick={() => this.submit(this.phone, this.code)}>
                            {app.translator.trans(`hamzone-auth-phone.forum.buttons.submit`)}
                        </Button>
                    </div>
                </div>
            </div>
        );
    }

    sendSMS(phone) {
        var t = typeof phone;
        if(t != 'string'){
            return;
        }
        this.loading = true;
        this.inputDisabled = true;

        if(phone.length!=11){
            this.loading = false;
            this.inputDisabled = false;
            app.alerts.show({ type: 'error' }, 
                app.translator.trans(`hamzone-auth-phone.forum.alerts.wrong_num`)
            );
            return;
        }
        app
            .request({
                url: app.forum.attribute('apiUrl') + "/auth/sms" + '/send',
                method: 'POST',
                body: { phone },
                errorHandler: this.onerror.bind(this),
            }).catch((error) => {
                this.inputDisabled = false;
                app.alerts.show(
                Alert,
                { type: 'error' },
                error
                );
            }).then((result) => {
                this.loading = false;
                this.display = true;
                
                this.inputDisabled = true;
                this.displaySend = "none";

                if(!result.status){
                    app.alerts.dismiss(alert);
                    switch(result.msg){
                        case "code_exist":
                            app.alerts.show({ type: 'error' }, app.translator.trans(`hamzone-auth-phone.forum.alerts.code_exist`,{
                                time: result.time
                            }));
                            break;
                        default:
                            this.inputDisabled = false;
                            app.alerts.show({ type: 'error' }, result.msg);
                            break;
                    }
                    return;
                }

                

                app.alerts.show({ type: 'success' }, app.translator.trans(`hamzone-auth-phone.forum.alerts.send_success`));
            });
    }

    submit(phone,code){
        // var t = typeof phone;
        // var c = typeof code;
        // if(t != 'string' || c != 'string'){
        //     return;
        // }
        console.log(phone,code);
        const user = app.session.user;
        user
          .save({
            phone: "test",
          })
          .then(() => console.log("Saved"));
        
        // app
        // .request({
        //     url: app.forum.attribute('apiUrl') + "/auth/sms" + '/bind',
        //     method: 'POST',
        //     // body: { phone, code },
        //     errorHandler: this.onerror.bind(this),
        // }).catch((error) => {
        //     app.alerts.show(
        //     Alert,
        //     { type: 'error' },
        //     error
        //     );
        // }).then((result) => {
           
        // });
    }
}