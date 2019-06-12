function downloadFile(repoId, path) {
    const url = `http://sofy.local/${repoId}/${path}`;
    let link = document.createElement('a');

    document.body.appendChild(link);

    link.href = url;
    link.click();
}

function deleteFile(repoId, path) {
    console.log('Deleting', repoId, path);
}
function deleteFile(repoId, file)
{
    if (confirm('Are you sure you want to delete this repository?')) {
        $.ajax({
            url: '/repositories/deleteRepository/repository_id/' + repoId,
            type: 'POST',
            dataType: 'json',
            success: function (response) {
                console.log(response);
                if (typeof response == 'undefined' || response.error) {
                    alert("An error occurred")
                }
                if (response.success) {
                    $('p#repo-' + repoId).remove();
                    alert("Repository deleted")
                }
            },
            error: function (response) {
                response = response.responseJSON;

                if (typeof response == 'undefined') {

                }
                if (typeof response.error != 'undefined') {
                    return [];
                }
            }
        });
    }
}
function createJsonTree(jsonData, containerId) {
    // jsonData = [ { }, { } ]
    // containerId = "#container"

    // 1. Adaugat iconite din font awesome (3.1.0) pentru noduri (V)
    // 2. Posibilitatea de delete a unui fisier.
    //      Adaugat o iconita de delete repositories
    //      La delete se apeleaza o functie JavaScript (goala) cu path-ul si id-ul repository-ului
    //      Doar fisierele se pot sterge, nu si folderele
    // 3. Sa se poata modifica numele fisierelor
    //      In cazul unei modificari e nevoie si de reposiroy_id
    // 4. La click pe un nod fisier (pe numele fisierului) sa inceapa downloadul acestuia
    //      Sa aiba si URL-ul de download
    //      sofy.local/repo/path-ul din tree

    // Separat
    //
    // 1. Pe pagina de login de ex ar trebui o validare javascript
    //      Prin care sa verifici ca fieldul de password si ala de confirm password sunt egale
    // 2. Ar trebui o functie js care sa verifice ca adresa de email e valida

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
        jsonRoots[res.name][res.version].push(`${res.resource}###${res.repository_id}`);
    });

    let data = [];

    const jsonPaths = Object.keys(jsonRoots)
        .forEach(osKey => {
            const os = jsonRoots[osKey];

            let root = {
                "text": osKey,
                "icon": icons.rootFolder,
                "children": []
            };

            Object.keys(os)
                .forEach(versionKey => {
                    let versionRoot = {
                        "text": versionKey,
                        "icon": icons.versionFolder,
                        "children": []
                    };

                    os[versionKey]
                        .forEach(resource => {
                            const res = resource.split('###')[0];
                            const repositoryId = resource.split('###')[1];

                            const split = res.split('/');

                            let path = {
                                "text": split[0],
                                "icon": icons.defaultFolder,
                                "children": [
                                    {
                                        "text": split[1],
                                        "icon": icons.defaultFolder,
                                        "children": [
                                            {
                                                "text": split[2],
                                                "id": icons.defaultFolder,
                                                "children": [
                                                    {
                                                        "text": split[3],
                                                        "icon": icons.file,
                                                        "id": `${repositoryId}###file`
                                                    }
                                                ]
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

    $(containerId)
    .on('delete_node.jstree', function(e, data) {
        const node = data.node;
        const nodeId = node.id;
        const path = node.text;

        if (nodeId.indexOf('###') !== -1) {
            const repoId = node.id.split('###')[0];

            deleteFile(repoId, path);
        }
    })
    .on('after_open.jstree', function() {
        $(".jstree-anchor").unbind("dblclick").on("dblclick", function (event) {
            const id = event.target.id;

            if (id.indexOf('###') !== -1) {
                const repositoryId = id.split('###')[0];
                const path = event.target.text;

                downloadFile(repositoryId, path);
            }
        });
    })
    .jstree({
        'core': {
            'data': data,
            'check_callback': true
        },
        'plugins': ['contextmenu']
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
