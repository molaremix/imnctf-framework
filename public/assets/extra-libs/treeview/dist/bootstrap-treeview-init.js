$(function () {

    var defaultData = [
        {
            text: 'Misc',
            href: '#misc',
            tags: ['4'],
            nodes: [
                {
                    text: 'Welcome',
                    href: '#welcome',
                    tags: ['0']
                }
            ]
        },
        {
            text: 'Web',
            href: '#web',
            tags: ['0']
        },
        {
            text: 'Crypt',
            href: '#crypt',
            tags: ['0']
        },
        {
            text: 'Re',
            href: '#re',
            tags: ['0']
        },
        {
            text: 'Forensic',
            href: '#forensic',
            tags: ['0']
        }
    ];

    $('#challenge-tree').treeview({

        expandIcon: 'ti-angle-right',
        onhoverColor: "rgba(0, 0, 0, 0.05)",
        selectedBackColor: "#03a9f3",
        collapseIcon: 'ti-angle-down',
        nodeIcon: 'fa fa-bookmark',
        data: defaultData
    });

    var initSelectableTree = function () {
        return $('#treeview-selectable').treeview({

            data: defaultData,
            multiSelect: $('#chk-select-multi').is(':checked'),
            onNodeSelected: function (event, node) {
                $('#selectable-output').prepend('<p>' + node.text + ' was selected</p>');
            },
            onNodeUnselected: function (event, node) {
                $('#selectable-output').prepend('<p>' + node.text + ' was unselected</p>');
            }
        });
    };
    var $selectableTree = initSelectableTree();

    var findSelectableNodes = function () {
        return $selectableTree.treeview('search', [$('#input-select-node').val(), {
            ignoreCase: false,
            exactMatch: false
        }]);
    };
    var selectableNodes = findSelectableNodes();

    $('#chk-select-multi:checkbox').on('change', function () {
        console.log('multi-select change');
        $selectableTree = initSelectableTree();
        selectableNodes = findSelectableNodes();
    });

    // Select/unselect/toggle nodes
    $('#input-select-node').on('keyup', function (e) {
        selectableNodes = findSelectableNodes();
        $('.select-node').prop('disabled', !(selectableNodes.length >= 1));
    });

    $('#btn-select-node.select-node').on('click', function (e) {
        $selectableTree.treeview('selectNode', [selectableNodes, {silent: $('#chk-select-silent').is(':checked')}]);
    });

    $('#btn-unselect-node.select-node').on('click', function (e) {
        $selectableTree.treeview('unselectNode', [selectableNodes, {silent: $('#chk-select-silent').is(':checked')}]);
    });

    $('#btn-toggle-selected.select-node').on('click', function (e) {
        $selectableTree.treeview('toggleNodeSelected', [selectableNodes, {silent: $('#chk-select-silent').is(':checked')}]);
    });


    var $expandibleTree = $('#treeview-expandible').treeview({
        data: defaultData,
        onNodeCollapsed: function (event, node) {
            $('#expandible-output').prepend('<p>' + node.text + ' was collapsed</p>');
        },
        onNodeExpanded: function (event, node) {
            $('#expandible-output').prepend('<p>' + node.text + ' was expanded</p>');
        }
    });

    var findExpandibleNodess = function () {
        return $expandibleTree.treeview('search', [$('#input-expand-node').val(), {
            ignoreCase: false,
            exactMatch: false
        }]);
    };
    var expandibleNodes = findExpandibleNodess();

    // Expand/collapse/toggle nodes
    $('#input-expand-node').on('keyup', function (e) {
        expandibleNodes = findExpandibleNodess();
        $('.expand-node').prop('disabled', !(expandibleNodes.length >= 1));
    });

    $('#btn-expand-node.expand-node').on('click', function (e) {
        var levels = $('#select-expand-node-levels').val();
        $expandibleTree.treeview('expandNode', [expandibleNodes, {
            levels: levels,
            silent: $('#chk-expand-silent').is(':checked')
        }]);
    });

    $('#btn-collapse-node.expand-node').on('click', function (e) {
        $expandibleTree.treeview('collapseNode', [expandibleNodes, {silent: $('#chk-expand-silent').is(':checked')}]);
    });

    $('#btn-toggle-expanded.expand-node').on('click', function (e) {
        $expandibleTree.treeview('toggleNodeExpanded', [expandibleNodes, {silent: $('#chk-expand-silent').is(':checked')}]);
    });

    // Expand/collapse all
    $('#btn-expand-all').on('click', function (e) {
        var levels = $('#select-expand-all-levels').val();
        $expandibleTree.treeview('expandAll', {levels: levels, silent: $('#chk-expand-silent').is(':checked')});
    });

    $('#btn-collapse-all').on('click', function (e) {
        $expandibleTree.treeview('collapseAll', {silent: $('#chk-expand-silent').is(':checked')});
    });


    var $checkableTree = $('#treeview-checkable').treeview({
        data: defaultData,
        showIcon: false,
        showCheckbox: true,
        onNodeChecked: function (event, node) {
            $('#checkable-output').prepend('<p>' + node.text + ' was checked</p>');
        },
        onNodeUnchecked: function (event, node) {
            $('#checkable-output').prepend('<p>' + node.text + ' was unchecked</p>');
        }
    });

    var findCheckableNodess = function () {
        return $checkableTree.treeview('search', [$('#input-check-node').val(), {
            ignoreCase: false,
            exactMatch: false
        }]);
    };
    var checkableNodes = findCheckableNodess();

    // Check/uncheck/toggle nodes
    $('#input-check-node').on('keyup', function (e) {
        checkableNodes = findCheckableNodess();
        $('.check-node').prop('disabled', !(checkableNodes.length >= 1));
    });

    $('#btn-check-node.check-node').on('click', function (e) {
        $checkableTree.treeview('checkNode', [checkableNodes, {silent: $('#chk-check-silent').is(':checked')}]);
    });

    $('#btn-uncheck-node.check-node').on('click', function (e) {
        $checkableTree.treeview('uncheckNode', [checkableNodes, {silent: $('#chk-check-silent').is(':checked')}]);
    });

    $('#btn-toggle-checked.check-node').on('click', function (e) {
        $checkableTree.treeview('toggleNodeChecked', [checkableNodes, {silent: $('#chk-check-silent').is(':checked')}]);
    });

    // Check/uncheck all
    $('#btn-check-all').on('click', function (e) {
        $checkableTree.treeview('checkAll', {silent: $('#chk-check-silent').is(':checked')});
    });

    $('#btn-uncheck-all').on('click', function (e) {
        $checkableTree.treeview('uncheckAll', {silent: $('#chk-check-silent').is(':checked')});
    });


    var $disabledTree = $('#treeview-disabled').treeview({
        data: defaultData,
        onNodeDisabled: function (event, node) {
            $('#disabled-output').prepend('<p>' + node.text + ' was disabled</p>');
        },
        onNodeEnabled: function (event, node) {
            $('#disabled-output').prepend('<p>' + node.text + ' was enabled</p>');
        },
        onNodeCollapsed: function (event, node) {
            $('#disabled-output').prepend('<p>' + node.text + ' was collapsed</p>');
        },
        onNodeUnchecked: function (event, node) {
            $('#disabled-output').prepend('<p>' + node.text + ' was unchecked</p>');
        },
        onNodeUnselected: function (event, node) {
            $('#disabled-output').prepend('<p>' + node.text + ' was unselected</p>');
        }
    });

    var findDisabledNodes = function () {
        return $disabledTree.treeview('search', [$('#input-disable-node').val(), {
            ignoreCase: false,
            exactMatch: false
        }]);
    };
    var disabledNodes = findDisabledNodes();

    // Expand/collapse/toggle nodes
    $('#input-disable-node').on('keyup', function (e) {
        disabledNodes = findDisabledNodes();
        $('.disable-node').prop('disabled', !(disabledNodes.length >= 1));
    });

    $('#btn-disable-node.disable-node').on('click', function (e) {
        $disabledTree.treeview('disableNode', [disabledNodes, {silent: $('#chk-disable-silent').is(':checked')}]);
    });

    $('#btn-enable-node.disable-node').on('click', function (e) {
        $disabledTree.treeview('enableNode', [disabledNodes, {silent: $('#chk-disable-silent').is(':checked')}]);
    });

    $('#btn-toggle-disabled.disable-node').on('click', function (e) {
        $disabledTree.treeview('toggleNodeDisabled', [disabledNodes, {silent: $('#chk-disable-silent').is(':checked')}]);
    });

    // Expand/collapse all
    $('#btn-disable-all').on('click', function (e) {
        $disabledTree.treeview('disableAll', {silent: $('#chk-disable-silent').is(':checked')});
    });

    $('#btn-enable-all').on('click', function (e) {
        $disabledTree.treeview('enableAll', {silent: $('#chk-disable-silent').is(':checked')});
    });


    var $tree = $('#treeview12').treeview({
        data: json
    });
});