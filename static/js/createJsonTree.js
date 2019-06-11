function createJsonTree(jsonData, containerId) {
    // jsonData = [ { }, { } ]
    // containerId = "#container"

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

                            console.log(split);
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