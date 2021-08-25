export async function updateProfile(form) {
    let name = form['name'].value
    let email = form['email'].value
    let response = await fetch(`/profile/${window.USERID}`, {
        method: 'PUT',
        headers: {
            'Content-Type' : 'application/json',
            'X-CSRF-TOKEN' : window.CSRF_TOKEN
        },
        body : JSON.stringify({
            name : name,
            email : email
        })
    })
    return response.json()
}
