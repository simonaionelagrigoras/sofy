function createJsonTree(jsonData, containerId) {
    // jsonData = [ { }, { } ]
    // containerId = "#container"
    // 1. Adaugat iconite din font awesome (3.1.0) pentru noduri
    //adaug o iconita de delte repositories
    //sa permita si modificarea lor
    //url de download ca poate l-a pierdut
    //motivul pentru care returneaza acel api si repository_id pentru ca incazul unei modificari e nevoie si de reposiroy id
    //tree-ul trebuie sa aiba posibilitatea de delete -> la delete e nevoie sa fie o iconita cu un x rosu acolo si sa apeleze o functie js cu path-ul fisierului si id-ul de repository
    //atenie, doar fisierele se pot sterge, nu si folderele
    //functia js sa fie goala ca o scriu eu
    //la click pe un nod fisier sa fie posibilitatea de download
    //practic trebuie ca js-ul sa extraga fisierul de la url-ul
    //sofy.local/repo/path-ul din tree
    //poate putem pune alte iconite
    //pe pagina de login de ex ar trebui o validare javascript
    //prin care sa verifici ca fieldul de password si ala de confirm password sunt egale
    //ar trebui o functie js care sa verifice ca adresa de email e valida

    const icons = {
        rootFolder: "fa icon-folder-open",
        versionFolder: "fa icon-folder-open",
        defaultFolder: "fa icon-folder-open",
        file: "fa icon-file"
    };

    let jsonRoots = {};

    jsonData.forEach(res => {
        jsonRoots[res.name] = jsonRoots[res.name] || {};
        jsonRoots[res.name][res.version] = jsonRoots[res.name][res.version] || [];
        jsonRoots[res.name][res.version].push(res.resource);
    });

    let data = [];

    const jsonPaths = Object.keys(jsonRoots)
        .forEach(osKey => {
            const os = jsonRoots[osKey];

            let root = {
                "text": osKey,
                "children": []
            };

            Object.keys(os)
                .forEach(versionKey => {
                    let versionRoot = {
                        "text": versionKey,
                        "children": []
                    };

                    os[versionKey]
                        .forEach(resource => {
                            const split = resource.split('/');

                            //console.log(split);
                            let path = {
                                "text": split[0],
                                "children": [
                                    {
                                        "text": split[1],
                                        "children": [
                                            {
                                                "text": split[2]
                                            }
                                        ]
                                    }

                                ]
                            };

                            versionRoot.children.push(path);
                        });

                    root.children.push(versionRoot);
                });

            data.push(root);
        });

    $(containerId).jstree({
        'core': {
            'data': data
        }
    });
}

function getUserRepositories() {
    $.ajax({
        url: '/repositories/getList',
        type: 'POST',
        dataType: 'json',
        success: function (response) {
            var result = '';

            if (typeof response.error != 'undefined') {
                alert(response.error);
            }
            createJsonTree(response, "#existent-repo");
            $.each(response, function (index, element) {
                console.log(element);
                $('#existent-repo');

            })
        },
        error: function (response) {
            var result = '';
            response = response.responseJSON;

            if (typeof response.error != 'undefined') {
                alert(response.error);
            }
        }
    });
}
getUserRepositories();


$(function () {
    const json = [
        {
            "repository_id": "36",
            "name": "centos-7",
            "version": "7.5.1804",
            "resource": "cloud\/x86_64\/PackagesPyQt4-doc-4.12-1.el7.noarch.rpm"
        },
        {
            "repository_id": "35",
            "name": "centos-7",
            "version": "7.4.1708",
            "resource": "demo2\/x86_64\/PackagesPyQt4-doc-4.12-1.el7.noarch.rpm"
        },
        {
            "repository_id": "37",
            "name": "centos-7",
            "version": "7.6.1810",
            "resource": "dotnet\/x86_64\/PackagesPyQt4-doc-4.12-1.el7.noarch.rpm"
        },
        {
            "repository_id": "37",
            "name": "centos-7",
            "version": "7.6.1810",
            "resource": "dotnet\/x86_64\/PackagesPyQt4-doc-4.12-1.el7.noarch.rpm"
        },
        {
            "repository_id": "2",
            "name": "centos-4",
            "version": "4.1",
            "resource": "s\/x86_64\/PackagesPyQt4-doc-4.12-1.el7.noarch.rpm"
        },
        {
            "repository_id": "2",
            "name": "centos-4",
            "version": "4.1",
            "resource": "s\/x86_64\/PackagesPyQt4-doc-4.12-1.el7.noarch.rpm"
        },
        {
            "repository_id": "1",
            "name": "centos-4",
            "version": "4.0",
            "resource": "ddd\/x86_64\/PackagesPyQt4-doc-4.12-1.el7.noarch.rpm"
        },
        {
            "repository_id": "2",
            "name": "centos-4",
            "version": "4.1",
            "resource": "s\/x86_64\/PackagesPyQt4-doc-4.12-1.el7.noarch.rpm"
        },
        {
            "repository_id": "21",
            "name": "centos-6",
            "version": "6.0",
            "resource": "wwwg\/x86_64\/PackagesPyQt4-doc-4.12-1.el7.noarch.rpm"
        },
        {
            "repository_id": "33",
            "name": "centos-7",
            "version": "7.2.1511",
            "resource": "demo\/x86_64\/PackagesPyQt4-doc-4.12-1.el7.noarch.rpm"
        },
        {
            "repository_id": "34",
            "name": "centos-7",
            "version": "7.3.1611",
            "resource": "zxc\/x86_64\/PackagesPyQt4-doc-4.12-1.el7.noarch.rpm"
        },
        {
            "repository_id": "32",
            "name": "centos-7",
            "version": "7.1.1503",
            "resource": "sss\/x86_64\/PackagesPyQt4-doc-4.12-1.el7.noarch.rpm"
        },
        {
            "repository_id": "32",
            "name": "centos-7",
            "version": "7.1.1503",
            "resource": "sss\/x86_64\/PackagesPyQt4-doc-4.12-1.el7.noarch.rpm"
        },
        {
            "repository_id": "32",
            "name": "centos-7",
            "version": "7.1.1503",
            "resource": "sss\/x86_64\/PackagesPyQt4-doc-4.12-1.el7.noarch.rpm"
        },
        {
            "repository_id": "32",
            "name": "centos-7",
            "version": "7.1.1503",
            "resource": "sss\/x86_64\/PackagesPyQt4-doc-4.12-1.el7.noarch.rpm"
        },
        {
            "repository_id": "34",
            "name": "centos-7",
            "version": "7.3.1611",
            "resource": "zxc\/x86_64\/PackagesPyQt4-doc-4.12-1.el7.noarch.rpm"
        },
        {
            "repository_id": "23",
            "name": "centos-6",
            "version": "6.2",
            "resource": "rrr\/x86_64\/PackagesPyQt4-doc-4.12-1.el7.noarch.rpm"
        },
        {
            "repository_id": "6",
            "name": "centos-4",
            "version": "4.5",
            "resource": "fdsgfdg\/x86_64\/PackagesPyQt4-doc-4.12-1.el7.noarch.rpm"
        }
    ];

    createJsonTree(json, "#container");
});
