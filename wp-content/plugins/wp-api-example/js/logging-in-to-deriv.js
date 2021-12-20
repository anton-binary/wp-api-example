const login = () => {
    const app_id = window.location.host == "localhost" ? "30772" : "30782";
    const api = new DerivAPIBasic({ endpoint: 'ws.binaryws.com', app_id: app_id });
    localStorage.setItem("app_id", app_id);
    window.location.href = "https://oauth.deriv.com/oauth2/authorize?app_id=" + app_id;
}

const parseQueryString = () => {
    const urlSearchParams = new URLSearchParams(window.location.search);
    const params = Object.fromEntries(urlSearchParams.entries());
    const keys = Object.keys(params);
    if(keys.length == 0) return;
    var acc = [];
    keys.forEach(k => {
        if(k.indexOf("acct") == 0) {
            acc.push({
                acc: params["acct" + k.charAt(4)],
                cur: params["cur" + k.charAt(4)],
                token: params["token" + k.charAt(4)]
            });
        }
    });
    document.getElementById('user_accounts').innerHTML = acc.map(a =>{
        return `
            <label class="item">
                <input name="accounts" type="radio" value="${a.token}" onchange="display_account_info(this)">
                <span class="selected">
                    <div class="a">${a.acc}</div>
                    <div class="b">${a.cur}</div>
                    <div class="button">Authorise</div>
                </span>
            </label>
        `;
    }).join('\n');
}

const display_account_info = (selected_account) => {
    const account = authorize(selected_account.value);
    account.then((a) =>{
        document.getElementById("account_info").innerHTML = a.map(field => {
            return `<div><strong>${field.name}: </strong>${field.value}</div>`;
        }).join("\n");
    });
}

const authorize = async (token) => {
    const app_id = localStorage.getItem("app_id");
    if(app_id != "") {
        const api = new DerivAPIBasic({ endpoint: 'ws.binaryws.com', app_id: app_id });
        const account = await api.authorize(token);
        return [
            { name: "Balance", value: account.authorize.currency + " " + account.authorize.balance },
            { name: "Email", value: account.authorize.email },
            { name: "Full name", value: account.authorize.fullname },
            { name: "Is virtual", value: account.authorize.is_virtual },
            { name: "Landing_company", value: account.authorize.landing_company_fullname },
            { name: "Preferred_language", value: account.authorize.preferred_language },
            { name: "Scopes", value: account.authorize.scopes.join(", ")}
        ];
    }
}