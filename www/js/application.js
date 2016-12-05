/**================================================
 JS : MY CUSTOM SCRIPTS
 ===================================================*/
$(document).ready(function () {

    //alert(window.location.pathname);

    //-- Essa rotina ajusta um problema que o multi-idiomas causa nos links, duplicando-os.
    $('a').each(function () {

        if ($(this).attr('data-route')) {
            var link = '/' + $('#app_locale').val() + $(this).data('route');
            $(this).attr('href', link);
        }

    })


    $('#enviar_faleconosco').click(function (e) {

        e.preventDefault();

        mensagem = 'Os campos abaixo são obrigatórios:\n';
        campos = ''
        if ($('#nome').val() == '') {
            campos += '\n - Seu nome'
        }

        if ($('#email').val() == '') {
            campos += '\n - Seu e-mail'
        }

        if ($('#assunto').val() == '') {
            campos += '\n - Assunto'
        }

        if ($('#mensagem').val() == '') {
            campos += '\n - Mensagem'
        }

        if (campos == '') {
            $(this).text('Enviando...');
            $('#form').submit();
        } else {
            alert(mensagem + campos);

        }


    });


    //-- Retorna os temas relacionados às linhas para preencher os select boxes do "Localizar Arquivos"
    $('#linha').on('change', function () {

        id = parseInt($(this).find(":selected").val());

        //URL atual, incluindo porta, protocolo e locale
        var url = window.location.href;
        url = url.split('/');
        url = url[0]+'//'+url[2]+'/'+url[3];

        console.log(url);
        $.ajax({
            url: url + '/linhas-busca',
            type: 'POST',
            data: {id: id},
            dataType: 'json',
            success: function (data) {

                $('#tema').attr('disabled', false);
                $('#tema').children('option:not(:first)').remove();

                $.each(data, function(name, value){

                    $('#tema').append( '<option value="' + value['id'] + '">' + value['title'] + '</option>' );

                });
            }
        });
    });


    //-- Retorna os subtemas relacionados aos temas para preencher os select boxes do "Localizar Arquivos"
    $('#tema').on('change', function () {

        id = parseInt($(this).find(":selected").val());

        //URL atual, incluindo porta, protocolo e locale
        var url = window.location.href;
        url = url.split('/');
        url = url[0]+'//'+url[2]+'/'+url[3];

        $.ajax({
            url: url + '/temas-busca',
            type: 'POST',
            data: {id: id},
            dataType: 'json',
            success: function (data) {

                $('#subtema').attr('disabled', false);
                $('#subtema').children('option:not(:first)').remove();

                $.each(data, function(name, value){

                    $('#subtema').append( '<option value="' + value['id'] + '">' + value['title'] + '</option>' );

                });
            }
        });
    });


    //$('#lightbox').click(function() {
    //	$('#lightbox').hide();
    //});

    //-- Botão EXIBIR MAIS RESULTADOS --
    $('body').on('click', '.btn-moreresults button', function (e) {

        e.preventDefault();
        var url = $(this).attr('data-proxima-pagina');
        var situacao = $(this).data('situation-id');
        botao = $(this);

        //$.get(url, 'situation_id=' + situacao, function (retorno) {
console.log(url);
        $.ajax({
            url: url,
            type: 'POST',
            data: 'situation_id=' + situacao,
            success: function (retorno) {

                if (situacao == 1) {
                    $('#em_andamento').append(retorno.resultados);

                } else if (situacao == 2) {
                    $('.em_analise').append(retorno.resultados);

                } else if (situacao == 3) {
                    $('.encerrados').append(retorno.resultados);

                } else if (situacao == 4) {
                    $('.cancelados').append(retorno.resultados);

                } else if (situacao == 'ultimas') {
                    $('#ultimas').append(retorno.resultados);

                } else if (situacao == 'recentes') {
                    $('#recentes').append(retorno.resultados);

                } else if (situacao == 'institucional') {
                    $('#institucional').append(retorno.resultados);
                }


                if (retorno.proxima_pagina == null) {
                    botao.hide();
                } else {
                    botao.attr('data-proxima-pagina', retorno.proxima_pagina);
                }


                $('a').each(function () {
                    if ($(this).attr('data-route')) {
                        var link = '/' + $('#app_locale').val() + $(this).data('route');
                        $(this).attr('href', link);
                    }
                });
            }
        })
    });

    $('#download').click(function (e) {
        e.preventDefault();
        var url = '/' + $('#app_locale').val() + $(this).data('link');

        window.location = url;

    });

    //-- Filtros laterais da busca --//
    $('.filtros ul a').on('click', function (e) {

        e.preventDefault();
        click = $(this).data('section');

        if (click == 'todos') {
            $('.beh-maisrecentes').show();
        } else {
            $('.beh-maisrecentes').hide();
            $('.beh-maisrecentes.' + click).show();
        }
        $('.subtitle-search').text($('.valor-filtro.' + click).text() + ' registros encontrados');

    });

    // Executa as funções
    menuMobile();
    searchBox();
    shareBox();
    printPage();

    // Ativa as abas
    $('.proj-abas a').click(function (e) {
        e.preventDefault();
        $(this).tab('show');
    });

    $(window).scroll(function () {
        var scroll = $(window).scrollTop();
        if (scroll < 300) {
            $('.page-index header').fadeIn(250);
        } else {
            $('.page-index header').fadeOut(250);
        }
    });
});

// Menu mobile
function menuMobile() {
    var abrirMenu = $('.open-menu');
    var fecharMenu = $('.close-menu');
    var menu = $('.nav-mobile');
    var largmenu = $('.nav-mobile').outerWidth();
    var abrir = false;

    menu.css('visibility', 'hidden');

    abrirMenu.click(function (event) {
        // toggle open class
        fecharMenu.fadeIn(200);
        menu.addClass('open');
        menu.css('visibility', 'visible');
        event.preventDefault();
        // slide menu
        if (menu.hasClass('open')) {
            menu.animate({
                right: '0em'
            }, 250);
        } else {
            menu.animate({
                right: -largmenu
            }, 250);
        }
    });

    fecharMenu.click(function (event) {
        event.preventDefault();
        if (menu.hasClass('open')) {
            fecharMenu.fadeOut();
            menu.animate({
                right: -largmenu
            }, 250);
        }
    });
}


// Exibe a caixa de pesquisa
function searchBox() {
    var iconeBusca = $('.icone-busca');
    var busca = $('nav.container .busca');
    var campo = $('input#form-busca');

    iconeBusca.hover(function () {
        busca.addClass('busca-ativo');

        // Fecha a caixa de pesquisa se nada for digitado
        var fechaCampo = setTimeout(function () {
            busca.removeClass('busca-ativo');
        }, 5000);

        // Mantém a caixa de pesquisa aberta se algo for digitado
        campo.keyup(function (e) {
            clearTimeout(fechaCampo);
        });
    });

    iconeBusca.click(function () {
        window.location.href = '/' + $('#app_locale').val() + '/busca/' + campo.val();
    })
    campo.keypress(function (e) {
        if (e.which == 13) {
            window.location.href = '/' + $('#app_locale').val() + '/busca/' + campo.val();
        }
    });
}


// Mostra os botões de compartilhamento
function shareBox() {
    var shareButton = $('.share-button');
    var box = $('.share-box');
    var fechaBox = $('.close-share');

    shareButton.click(function () {
        box.fadeIn(250);
    });

    fechaBox.click(function () {
        box.fadeOut(250);
        return false;
    })

    // Esconde a div se o clique for fora dela
    $(document).click(function () {
        if (!$(event.target).closest(shareButton).length) {
            box.fadeOut(250);
        }
    });
}


// Imprime a página
function printPage() {
    $('.print-button').click(function () {
        window.print();
    });
}

function createLineChart(settings) {

    var chart_id = '#' + settings.id;

    function number_in_pt_BR(value, decimal_digits) {
        number = value.toLocaleString('pt-BR', {maximumFractionDigits: decimal_digits});
        return number;
    }

    var pt_BR = d3.locale({
        "decimal": ",",
        "thousands": ".",
        "grouping": [3],
        "currency": ["R$", "reais"],
        "dateTime": "%a %b %e %X %Y",
        "date": "%d/%m/%Y",
        "time": "%H:%M:%S",
        "periods": ["AM", "PM"],
        "days": ["Domingo", "Segunda", "Terça", "Quarta", "Quinta", "Sexta", "Sábado"],
        "shortDays": ["Dom", "Seg", "Ter", "Qua", "Qui", "Sex", "Sab"],
        "months": ["Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho", "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro"],
        "shortMonths": ["Jan", "Fev", "Mar", "Abr", "Mai", "Jun", "Jul", "Ago", "Set", "Out", "Nov", "Dez"]
    });

    function grafico() {
        var widthTem = $(chart_id).width();
        var heightTem = $(chart_id).height();

        //set the margins
        var margin = {top: 0, right: 10, bottom: 0, left: 38},
            width = widthTem,
            height = heightTem;


        //set dek and head to be as wide as SVG
        d3.select('#dek')
            .style('width', width + 'px');
        d3.select('#headline')
            .style('width', width + 'px');

        //write out your source text here
        var sourcetext = "Source: XXXXX";

        // set the type of number here, n is a number with a comma, .2% will get you a percent, .2f will get you 2 decimal points
        var NumbType = d3.format(".2f");

        // color array
        var bluescale4 = ["#fff", "#ff0000", "#066CA9", "#004B8C"];

        //color function pulls from array of colors stored in color.js
        var color = d3.scale.ordinal().range(bluescale4);

        //define the approx. number of x scale ticks
        var xscaleticks = 5;

        //defines a function to be used to append the title to the tooltip.  you can set how you want it to display here.
        var maketip = function (d) {
            var tip = '<p class="tip1">' + NumbType(d.value) + '</p><p></p>';
            return tip;
        }

        //define your year format here, first for the x scale, then if the date is displayed in tooltips
        var parseDate = d3.time.format("%m/%d/%y").parse;
        var formatDate = pt_BR.timeFormat("%b %d, '%y");

        //create an SVG
        var svg = d3.select(chart_id).append("svg")
            .attr("width", width + margin.left + margin.right)
            .attr("height", height + margin.top + margin.bottom)
            .append("g")
            .attr("transform", "translate(" + margin.left + "," + (margin.top + 4) + ")");


        //make a rectangle so there is something to click on
        svg.append("svg:rect")
            .attr("width", width)
            .attr("height", height)
            .attr("class", "plot")
            .attr('fill', 'transparent');

        //make a clip path for the graph
        var clip = svg.append("svg:clipPath")
            .attr("id", settings.id + "-clip")
            .append("svg:rect")
            .attr("x", 0)
            .attr("y", 0)
            .attr("width", width)
            .attr("height", height);

        // force data to update when menu is changed
        // var menu = d3.select('#'+settings.menu_id+' select')
        // 	.on("change", change);

        var first_data = {};
        var last_data = {};

        //suck in the data, store it in a value called formatted, run the redraw function
        //Comentado para remover arquivo local CSV
        //d3.csv(settings.data_file, function(data) {
        //	formatted = data;
        //	redraw();
        //});

        //Alterado para leitura de JSON
        function draw(data) {
            formatted = data;
            redraw();
        }

        draw(settings.data_file);

        d3.select(window)
            .on("keydown", function () {
                altKey = d3.event.altKey;
            })
            .on("keyup", function () {
                altKey = false;
            });
        var altKey;

        // set terms of transition that will take place
        // when a new economic indicator is chosen
        function change() {
            d3.transition()
                .duration(altKey ? 7500 : 1500)
                .each(redraw);
        }


        // all the meat goes in the redraw function
        function redraw() {
            var last_tip_element = {};

            widthTem = $(chart_id).width() - 35;
            heightTem = $(chart_id).height() - 40;
            //set the margins
            margin = {top: 0, right: 0, bottom: 0, left: 10},
                width = widthTem,
                height = heightTem;

            svg.select("rect")
                .attr("width", width)
                .attr("height", height)
                .attr("class", "plot")
                .attr("fill", "transparent");


            var clip = svg.append("svg:clipPath")
                .attr("id", settings.id + "-clip")
                .append("svg:rect")
                .attr("x", 0)
                .attr("y", 0)
                .attr("width", width)
                .attr("height", height);

            //$("#graphic svg")
            //  .attr("width", width)
            //.attr("height", height)

            //$("#graphic svg g:first")
            //  .attr("width", width)
            //.attr("height", height);

            //svg
            //  .attr("width", width)
            //.attr("height", height)


            // create data nests based on economic indicator (series)
            var nested = d3.nest()
                .key(function (d) {
                    return d.type;
                })
                .map(formatted)

            // get value from menu selection
            // the option values are set in HTML and correspond
            //to the [type] value we used to nest the data
            // var series = menu.property("value");

            // only retrieve data from the selected series, using the nest we just created
            var data = nested['val1'];
            //console.log(data);


            // for object constancy we will need to set "keys", one for each type of data (column name) exclude all others.
            color.domain(d3.keys(data[0]).filter(function (key) {
                return (key !== "date" && key !== "type");
            }));

            var linedata = color.domain().map(function (name) {
                return {
                    name: name,
                    values: data.map(function (d) {
                        return {name: name, date: parseDate(d.date), value: parseFloat(d[name], 2)};
                    })
                };
            });

            //make an empty variable to stash the last values into so i can sort the legend
            var lastvalues = [];

            //setup the x and y scales
            var x = d3.time.scale()
                .domain([
                    d3.min(linedata, function (c) {
                        return d3.time.month.offset(d3.min(c.values, function (v) {
                            return v.date;
                        }), -3);
                    }),
                    d3.max(linedata, function (c) {
                        return d3.time.month.offset(d3.max(c.values, function (v) {
                            return v.date;
                        }), 8);
                    })
                ])
                .range([0, width]);

            var y = d3.scale.linear()
                .domain([
                    d3.min(linedata, function (c) {
                        return d3.min(c.values, function (v) {
                                return v.value;
                            }) - (2 * ((d3.max(c.values, function (v) {
                                return v.value;
                            }) - (d3.min(c.values, function (v) {
                                return v.value;
                            })) ) / 9.0));
                    }),
                    d3.max(linedata, function (c) {
                        return d3.max(c.values, function (v) {
                                return v.value;
                            }) + (3 * ((d3.max(c.values, function (v) {
                                return v.value;
                            }) - (d3.min(c.values, function (v) {
                                return v.value;
                            })) ) / 9.0));
                    })
                ])
                .range([height, 0]);

            var nome_limites = [color.domain()[1], color.domain()[2]];
            var limite = {
                'superior': data[0][nome_limites[0]],
                'inferior': data[0][nome_limites[1]]
            };

            // console.log('sup: ',y(limite.superior));
            // console.log('inf: ',y(limite.inferior));

            //Comment Fabrício
            //if($(chart_id+" svg rect.gray_area").length == 0){
            //	svg.append("svg:rect")
            //		.attr("y", y(limite.superior))
            //		.attr("width", width)
            //		.attr("height", y(limite.inferior) - y(limite.superior))
            //		.attr("class", "gray_area")
            //		.style("fill","#ddd");
            //}


            //will draw the line
            var line = d3.svg.line()
                .x(function (d) {
                    return x(d.date);
                })
                .y(function (d) {
                    return y(d.value);
                })
                .interpolate('linear');

            // console.log(line_values);


            //define the zoom
            // var zoom = d3.behavior.zoom()
            //     .x(x)
            //     .y(y)
            //     .scaleExtent([1,8])
            //     .on("zoom", zoomed);

            //call the zoom on the SVG
            // svg.call(zoom);

            //create and draw the x axis
            var xAxis = d3.svg.axis()
                .scale(x)
                .orient("bottom")
                .ticks(d3.time.years, 1)
                .tickFormat(pt_BR.timeFormat("%Y"));
            ;

            if ($(chart_id + " svg .x.axis").length) {
                $(chart_id + " svg .x.axis").remove();
            }


            svg.append("svg:g")
                .attr("class", "x axis")
                .attr("transform", "translate(0," + (height) + ")")
                .call(xAxis);

            //create and draw the y axis
            var yAxis = d3.svg.axis()
                .scale(y)
                .orient("left")
                .tickSize(-width)
                .tickPadding(8)
                .tickFormat(pt_BR.numberFormat('.2s'));

            svg.append("svg:g")
                .attr("class", "y axis")


            //bind the data
            var thegraph = svg.selectAll('.' + settings.id + '-thegraph')
                .data([linedata[0]])

            //append a g tag for each line and set of tooltip circles and give it a unique ID based on the column name of the data
            var thegraphEnter = thegraph.enter().append("g")
                .attr("clip-path", "url(#clip)")
                .attr("class", settings.id + "-thegraph")
                .attr('fill', 'transparent')
                .attr('id', function (d) {
                    return settings.id + '-' + d.name + "-line";
                })
                .style("stroke-width", 2)
                .on("mouseover", function (d) {
                    // d3.select(this)                          //on mouseover of each line, give it a nice thick stroke
                    // .style("stroke-width",'6px');

                    var selectthegraphs = $('.' + settings.id + '-thegraph').not(this);     //select all the rest of the lines, except the one you are hovering on and drop their opacity
                    d3.selectAll(selectthegraphs)
                        .style("opacity", 0.2);

                    var getname = document.getElementById(d.name);    //use get element cause the ID names have spaces in them
                    var selectlegend = $('.legend').not(getname);    //grab all the legend items that match the line you are on, except the one you are hovering on

                    // d3.selectAll(selectlegend)    // drop opacity on other legend names
                    //     .style("opacity",.2);

                    // d3.select(getname)
                    //     .attr("class", "legend-select");  //change the class on the legend name that corresponds to hovered line to be bolder
                })
                .on("mouseout", function (d) {        //undo everything on the mouseout
                    d3.select(this)
                        .style("stroke-width", '2px');

                    var selectthegraphs = $('.' + settings.id + '-thegraph').not(this);
                    d3.selectAll(selectthegraphs)
                        .style("opacity", 1);

                    var getname = document.getElementById(d.name);
                    var getname2 = $('.legend[fakeclass="fakelegend"]')
                    var selectlegend = $('.legend').not(getname2).not(getname);

                    // d3.selectAll(selectlegend)
                    //     .style("opacity",1);

                    // d3.select(getname)
                    //     .attr("class", "legend");
                });

            var valuePos = {'x': 0, 'y': 20};
            var datePos = {'x': 0, 'y': 20};

            first_data = thegraphEnter[0][0].__data__.values[0];
            last_data = thegraphEnter[0][0].__data__.values[thegraphEnter[0][0].__data__.values.length - 1];


            svg.append("svg:defs")
                .append("pattern")
                .attr("id", "imgpattern")
                .attr("x", 0)
                .attr("y", 0)
                .attr("width", 1)
                .attr("height", 1)
                .append("image")
                .attr("width", "51")
                .attr("height", "33")
                .attr("xlink:href", "/images/bg_valor-atual-grafico.png");

            if ($(chart_id + " svg rect.last_tip").length == 0) {
                last_tip_element = svg.append("svg:rect")
                    .attr("x", x(last_data.date) - 25)
                    .attr("y", y(last_data.value) - 37)
                    .attr("width", 100)
                    .attr("height", 33)
                    .attr("text-align", "center")
                    .attr("class", "last_tip")
                    .style("fill", "url(#imgpattern)")
                    .attr('opacity', 1);
            }
            //console.log(last_tip_element);

            //Formantando valor para o tiptext
            var numero_tip_text = Math.round(number_in_pt_BR(last_data.value, 1));
            var tiptext = svg.selectAll('.tip_text')
                .data([{
                    'posX': x(last_data.date) - 15,
                    'posY': y(last_data.value) - 18,
                    'text': pt_BR.numberFormat(".3s")(numero_tip_text)
                }])
                .enter()
                .append("text")
                .attr('class', 'tip_text');
            var tipLabel = tiptext
                .attr("x", function (d) {
                    return d.posX;
                })
                .attr("y", function (d) {
                    return d.posY;
                })
                .text(function (d) {
                    return d.text;
                });

            var circle = svg.append('circle')
                .attr('opacity', 0)
                .attr({
                    r: 6,
                    fill: '#c0ba45'
                });

            svg.on('mousemove', function () {
                var xPos = d3.mouse(this)[0];
                var selected_value = 0.0;
                var selected_date;
                var selected_original_value;

                if (xPos < x(first_data.date)) {
                    xPos = x(first_data.date);
                    selected_value = first_data.value.toFixed(2);
                    selected_date = pt_BR.timeFormat("%b, '%y")(first_data.date);
                    selected_original_value = first_data.value;
                }
                else if (xPos > x(last_data.date)) {
                    xPos = x(last_data.date);
                    selected_value = '';
                    selected_date = pt_BR.timeFormat("%b, '%y")(last_data.date);
                    selected_original_value = last_data.value;
                }
                else {
                    var selected_point = {};
                    var distance = x(last_data.date);

                    thegraphEnter[0][0].__data__.values.forEach(function (v) {
                        if (Math.abs(x(v.date) - xPos) < distance) {
                            selected_point = v;
                            selected_date = pt_BR.timeFormat("%b, '%y")(v.date);
                            selected_value = number_in_pt_BR(v.value, 1);
                            distance = Math.abs(x(v.date) - xPos);
                        }
                    });

                    xPos = x(selected_point.date);
                    selected_original_value = selected_point.value;
                }

                // var pathLength = d3.select('path.line').node().getTotalLength();
                var mouseX = xPos;
                // var beginning = mouseX,
                //     end = pathLength,
                //     target;

                // while (true) {
                //     target = Math.floor((beginning + end) / 2);
                //     pos = d3.select('path.line').node().getPointAtLength(target);
                //
                //     if ((target === end || target === beginning) && pos.x !== mouseX) {
                //         break;
                //     }
                //
                //     if (pos.x > mouseX) {
                //         end = target;
                //     }
                //     else if (pos.x < mouseX) {
                //         beginning = target;
                //     }
                //     else {
                //         break; //position found
                //     }
                // }


                circle.attr("opacity", 1)
                    .attr("cx", mouseX)
                    .attr("cy", y(selected_original_value));


                // svg.selectAll('.value_text').remove();
                svg.selectAll('.date_text').remove();

                valuePos.x = mouseX + 5;
                if (mouseX < 80) {
                    datePos.x = valuePos.x;

                    valuePos.y = datePos.y + 20;
                }
                else if (mouseX > 400) {
                    datePos.x = mouseX - 80;

                    valuePos.x = mouseX - 80;
                    valuePos.y = datePos.y + 20;
                }
                else {
                    valuePos.y = datePos.y;
                    datePos.x = mouseX - 80;
                }

                // var valuetext = svg.selectAll('.value_text')
                //     .data([{'posX': valuePos.x,'posY': valuePos.y, 'text': ''+selected_value}])
                //     .enter()
                //     .append("text")
                //     .attr('class','value_text');
                // var datetext = svg.selectAll('.date_text')
                //     .data( [ { 'posX': datePos.x,'posY': datePos.y, 'text': ''+ selected_date } ] )
                //     .enter()
                //     .append("text")
                //     .attr('class','date_text');

                // var valueLabel = valuetext
                //    .attr("x", function(d) { return d.posX; })
                //    .attr("y", function(d) { return d.posY; })
                //    .text( function (d) { return d.text; })
                //    .attr("font-family", "sans-serif")
                //    .attr("font-size", "12px")
                //    .attr("fill", "black");
                // var dateLabel = datetext
                //     .attr("x", function(d) { return d.posX; })
                //     .attr("y", function(d) { return d.posY; })
                //     .text( function (d) { return d.text; })
                //     .attr("font-family", "sans-serif")
                //     .attr("font-size", "12px")
                //     .attr("fill", "gray");

                //console.log(last_tip_element);
                last_tip_element
                    .attr("x", mouseX - 25)
                    .attr("y", y(selected_original_value) - 37);

                var numero_tip_text = Math.round((number_in_pt_BR(selected_original_value, 1)));
                tiptext
                    .attr('x', mouseX - 15)
                    .attr('y', y(selected_original_value) - 18)
                    .text(function () {
                        return (pt_BR.numberFormat(".3s")(numero_tip_text));
                    });

                // console.log("x and y coordinate where vertical line intersects graph: " + [pos.x, pos.y]);
                // console.log("data where vertical line intersects graph: " + [x.invert(pos.x), y.invert(pos.y)]);
            });

            //actually append the line to the graph
            thegraphEnter.append("path")
                .attr("class", "line")
                .style("stroke", function (d) {
                    return color(d.name);
                })
                .attr("d", function (d) {
                    return line(d.values[0]);
                })
                .transition()
                .duration(2000)
                .attrTween('d', function (d) {
                    var interpolate = d3.scale.quantile()
                        .domain([0, 1])
                        .range(d3.range(1, d.values.length + 1));
                    return function (t) {
                        return line(d.values.slice(0, interpolate(t)));
                    };
                });

            //then append some 'nearly' invisible circles at each data point
            thegraph.selectAll("circle")
                .data(function (d) {
                    return [d.values[d.values.length - 1]];
                })
                .enter()
                .append("circle")
                .attr("class", "tipcircle")
                .attr("cx", function (d, i) {
                    return x(d.date)
                })
                .attr("cy", function (d, i) {
                    return y(d.value)
                })
                .attr("r", 4)
                .attr('fill', 'white')
                // .style('opacity', 1e-6)//1e-6
                .attr("title", maketip);

            //append the legend
            var legend = svg.selectAll('.legend')
                .data(linedata);

            var legendEnter = legend
                .enter()
                .append('g')
                .attr('class', 'legend')
                .attr('id', function (d) {
                    return d.name;
                })
                .on('click', function (d) {                           //onclick function to toggle off the lines
                    if ($(this).css("opacity") == 1) {                  //uses the opacity of the item clicked on to determine whether to turn the line on or off

                        var elemented = document.getElementById(this.id + "-line");   //grab the line that has the same ID as this point along w/ "-line"  use get element cause ID has spaces
                        d3.select(elemented)
                            .transition()
                            .duration(1000)
                            .style("opacity", 0)
                            .style("display", 'none');

                        d3.select(this)
                            .attr('fakeclass', 'fakelegend')
                            .transition()
                            .duration(1000)
                            .style("opacity", .2);
                    } else {

                        var elemented = document.getElementById(this.id + "-line");
                        d3.select(elemented)
                            .style("display", "block")
                            .transition()
                            .duration(1000)
                            .style("opacity", 1);

                        d3.select(this)
                            .attr('fakeclass', 'legend')
                            .transition()
                            .duration(1000)
                            .style("opacity", 1);
                    }
                });

            //create a scale to pass the legend items through
            var legendscale = d3.scale.ordinal()
                .domain(lastvalues)
                .range([0, 30, 60, 90, 120, 150, 180, 210]);

            //actually add the circles to the created legend container
            legendEnter.append('circle')
                .attr('cx', width + 20)
                .attr('cy', function (d) {
                    return legendscale(d.values[d.values.length - 1].value);
                })
                .attr('r', 7)
                .style('fill', function (d) {
                    return color(d.name);
                });

            //add the legend text
            legendEnter.append('text')
                .attr('x', width + 35)
                .attr('y', function (d) {
                    return legendscale(d.values[d.values.length - 1].value);
                })
                .text(function (d) {
                    return d.name;
                });


            // set variable for updating visualization
            var thegraphUpdate = d3.transition(thegraph);

            // change values of path and then the circles to those of the new series
            thegraphUpdate.select("path")
                .attr("d", function (d, i) {

                    //must be a better place to put this, but this works for now
                    lastvalues[i] = d.values[d.values.length - 1].value;
                    lastvalues.sort(function (a, b) {
                        return b - a
                    });
                    legendscale.domain(lastvalues);

                    return line(d.values);
                });

            thegraphUpdate.selectAll("circle")
                .attr("title", maketip)
                .attr("cy", function (d, i) {
                    return y(d.value)
                })
                .attr("cx", function (d, i) {
                    return x(d.date)
                });


            // and now for legend items
            var legendUpdate = d3.transition(legend);

            legendUpdate.select("circle")
                .attr('cy', function (d, i) {
                    return legendscale(d.values[d.values.length - 1].value);
                });

            legendUpdate.select("text")
                .attr('y', function (d) {
                    return legendscale(d.values[d.values.length - 1].value);
                });


            // update the axes,
            d3.transition(svg).select(".y.axis")
                .call(yAxis);

            d3.transition(svg).select(".x.axis")
                .call(xAxis);

            //make my tooltips work
            // $('circle').tipsy({opacity:0.9, gravity:'n', html:true});


            //define the zoom function
            // function zoomed() {
            //
            //     svg.select(".x.axis").call(xAxis);
            //     svg.select(".y.axis").call(yAxis);
            //
            //     svg.selectAll(".tipcircle")
            //         .attr("cx", function(d,i){return x(d.date)})
            //         .attr("cy",function(d,i){return y(d.value)});
            //
            //     svg.selectAll(".line")
            //         .attr("class","line")
            //         .attr("d", function (d) { return line(d.values)});
            // }
            svg.attr("width", widthTem).attr("height", heightTem);

            //end of the redraw function
        }

        svg.append("svg:text")
            .attr("text-anchor", "start")
            .attr("x", 0 - margin.left)
            .attr("y", height + margin.bottom - 10)
            .attr("class", "source");

        //d3.select(window).on('resize', redraw);

        $(window).resize(function () {
            redraw();
        });
    }

    grafico();
}

// circles
// copyright Artan Sinani
// https://github.com/lugolabs/circles

/*
 Lightwheight JavaScript library that generates circular graphs in SVG.

 Call Circles.create(options) with the following options:

 id         - the DOM element that will hold the graph
 radius     - the radius of the circles
 width      - the width of the ring (optional, has value 10, if not specified)
 value      - init value of the circle (optional, defaults to 0)
 maxValue   - maximum value of the circle (optional, defaults to 100)
 text       - the text to display at the centre of the graph (optional, the current "htmlified" value will be shown if not specified)
 if `null` or an empty string, no text will be displayed
 can also be a function: the returned value will be the displayed text
 ex1. function(currentValue) {
 return '$'+currentValue;
 }
 ex2.  function() {
 return this.getPercent() + '%';
 }
 colors     - an array of colors, with the first item coloring the full circle
 (optional, it will be `['#EEE', '#F00']` if not specified)
 duration   - value in ms of animation duration; (optional, defaults to 500);
 if 0 or `null` is passed, the animation will not run
 wrpClass     - class name to apply on the generated element wrapping the whole circle.
 textClass:   - class name to apply on the generated element wrapping the text content.

 API:
 updateRadius(radius) - regenerates the circle with the given radius (see spec/responsive.html for an example hot to create a responsive circle)
 updateWidth(width) - regenerates the circle with the given stroke width
 updateColors(colors) - change colors used to draw the circle
 update(value, duration) - update value of circle. If value is set to true, force the update of displaying
 getPercent() - returns the percentage value of the circle, based on its current value and its max value
 getValue() - returns the value of the circle
 getMaxValue() - returns the max value of the circle
 getValueFromPercent(percentage) - returns the corresponding value of the circle based on its max value and given percentage
 htmlifyNumber(number, integerPartClass, decimalPartClass) - returned HTML representation of given number with given classes names applied on tags

 */

(function () {
    "use strict";

    var requestAnimFrame = window.requestAnimationFrame ||
            window.webkitRequestAnimationFrame ||
            window.mozRequestAnimationFrame ||
            window.oRequestAnimationFrame ||
            window.msRequestAnimationFrame ||
            function (callback) {
                setTimeout(callback, 1000 / 60);
            },

        Circles = window.Circles = function (options) {
            var elId = options.id;
            this._el = document.getElementById(elId);

            if (this._el === null) return;

            options.colors = this._selectColors(options.state, options.backgroundColor);

            this._radius = this._selectRadius(options.size);
            this._duration = options.duration === undefined ? 500 : options.duration;

            this._value = 0;
            this._maxValue = options.maxValue || 100;

            this._text = options.text === undefined ? function (value) {
                return this.htmlifyNumber(value);
            } : options.text;
            this._strokeWidth = this._selectWidth(options.size);
            this._colors = options.colors || ['#EEE', '#F00'];
            this._svg = null;
            this._movingPath = null;
            this._wrapContainer = null;
            this._textContainer = null;

            this._wrpClass = options.wrpClass || 'circles-wrp';
            this._textClass = options.textClass || 'circles-text';

            this._valClass = options.valueStrokeClass || 'circles-valueStroke';
            this._maxValClass = options.maxValueStrokeClass || 'circles-maxValueStroke';

            this._styleWrapper = options.styleWrapper === false ? false : true;
            this._styleText = options.styleText === false ? false : true;

            this._start = -Math.PI / 180 * (options.start_angle || 90);
            var endAngleRad = Math.PI / 180 * 270;
            this._startPrecise = this._precise(this._start);
            this._circ = endAngleRad - this._start;

            this._generate().update(options.value || 0);
        };

    Circles.prototype = {
        VERSION: '0.0.6',

        _generate: function () {

            this._svgSize = this._radius * 2;
            this._radiusAdjusted = this._radius - (this._strokeWidth / 2);

            this._generateSvg()._generateText()._generateWrapper();

            this._el.innerHTML = '';
            this._el.appendChild(this._wrapContainer);

            return this;
        },

        _selectRadius: function (graph_size) {
            var radius_available = [];
            radius_available['lg-1'] = 190;
            radius_available['md-1'] = 45;
            radius_available['sm-1'] = 80;


            return radius_available[graph_size] || 10;
        },

        _selectWidth: function (graph_size) {
            var width_available = [];
            width_available['lg-1'] = 15;
            width_available['md-1'] = 10;
            width_available['sm-1'] = 8;

            width_available['lg-2'] = 7;
            width_available['md-2'] = 5;
            width_available['sm-2'] = 3;

            return width_available[graph_size] || 10;
        },

        _selectColors: function (state, backgroundColor) {
            var state_colors = [];
            state_colors["01"] = "#c0ba45";
            state_colors["02"] = "#a97462";
            state_colors["03"] = "#624853";

            return [backgroundColor, state_colors[state]];
        },

        _setPercentage: function (percentage) {
            this._movingPath.setAttribute('d', this._calculatePath(percentage, true));
            this._textContainer.innerHTML = this._getText(this.getValueFromPercent(percentage));
        },

        _generateWrapper: function () {
            this._wrapContainer = document.createElement('div');
            this._wrapContainer.className = this._wrpClass;

            if (this._styleWrapper) {
                this._wrapContainer.style.position = 'relative';
                this._wrapContainer.style.display = 'inline-block';
            }

            this._wrapContainer.appendChild(this._svg);
            this._wrapContainer.appendChild(this._textContainer);

            return this;
        },

        _generateText: function () {

            this._textContainer = document.createElement('div');
            this._textContainer.className = this._textClass;

            if (this._styleText) {
                var style = {
                    //position:   'absolute',
                    //top:        0,
                    //left:       0,
                    //textAlign:  'center',
                    //width:      '100%',
                    //fontSize:   (this._radius * .7) + 'px',
                    //height:     this._svgSize + 'px',
                    //lineHeight: this._svgSize + 'px'
                };

                for (var prop in style) {
                    this._textContainer.style[prop] = style[prop];
                }
            }

            this._textContainer.innerHTML = this._getText(0);
            return this;
        },

        _getText: function (value) {
            if (!this._text) return '';

            if (value === undefined) value = this._value;

            value = parseFloat(value.toFixed(2));

            return typeof this._text === 'function' ? this._text.call(this, value) : this._text;
        },

        _generateSvg: function () {

            this._svg = document.createElementNS('http://www.w3.org/2000/svg', 'svg');
            this._svg.setAttribute('xmlns', 'http://www.w3.org/2000/svg');
            this._svg.setAttribute('width', this._svgSize);
            this._svg.setAttribute('height', this._svgSize);

            this._generatePath(100, false, this._colors[0], this._maxValClass)._generatePath(1, true, this._colors[1], this._valClass);

            this._movingPath = this._svg.getElementsByTagName('path')[1];

            return this;
        },

        _generatePath: function (percentage, open, color, pathClass) {
            var path = document.createElementNS('http://www.w3.org/2000/svg', 'path');
            path.setAttribute('fill', 'transparent');
            path.setAttribute('stroke', color);
            path.setAttribute('stroke-width', this._strokeWidth);
            path.setAttribute('d', this._calculatePath(percentage, open));
            path.setAttribute('class', pathClass);

            this._svg.appendChild(path);

            return this;
        },

        _calculatePath: function (percentage, open) {
            var end = this._start + ((percentage / 100) * Math.PI * 2),
                endPrecise = this._precise(end);
            return this._arc(endPrecise, open);
        },

        _arc: function (end, open) {
            var endAdjusted = end - 0.001,
                longArc = end - this._startPrecise < Math.PI ? 0 : 1;

            return [
                'M',
                this._radius + this._radiusAdjusted * Math.cos(this._startPrecise),
                this._radius + this._radiusAdjusted * Math.sin(this._startPrecise),
                'A', // arcTo
                this._radiusAdjusted, // x radius
                this._radiusAdjusted, // y radius
                0, // slanting
                longArc, // long or short arc
                1, // clockwise
                this._radius + this._radiusAdjusted * Math.cos(endAdjusted),
                this._radius + this._radiusAdjusted * Math.sin(endAdjusted),
                open ? '' : 'Z' // close
            ].join(' ');
        },

        _precise: function (value) {
            return Math.round(value * 1000) / 1000;
        },

        /*== Public methods ==*/

        htmlifyNumber: function (number, integerPartClass, decimalPartClass) {

            integerPartClass = integerPartClass || 'circles-integer';
            decimalPartClass = decimalPartClass || 'circles-decimals';

            var parts = (number + '').split('.'),
                html = '<span class="' + integerPartClass + '">' + parts[0] + '</span>';

            if (parts.length > 1) {
                html += '.<span class="' + decimalPartClass + '">' + parts[1].substring(0, 2) + '</span>';
            }
            return html;
        },

        updateRadius: function (radius) {
            this._radius = radius;

            return this._generate().update(true);
        },

        updateWidth: function (width) {
            this._strokeWidth = width;

            return this._generate().update(true);
        },

        updateColors: function (colors) {
            this._colors = colors;

            var paths = this._svg.getElementsByTagName('path');

            paths[0].setAttribute('stroke', colors[0]);
            paths[1].setAttribute('stroke', colors[1]);

            return this;
        },

        getPercent: function () {
            return (this._value * 100) / this._maxValue;
        },

        getValueFromPercent: function (percentage) {
            return (this._maxValue * percentage) / 100;
        },

        getValue: function () {
            return this._value;
        },

        getMaxValue: function () {
            return this._maxValue;
        },

        update: function (value, duration) {
            if (value === true) {//Force update with current value
                this._setPercentage(this.getPercent());
                return this;
            }

            if (this._value == value || isNaN(value)) return this;
            if (duration === undefined) duration = this._duration;

            var self = this,
                oldPercentage = self.getPercent(),
                delta = 1,
                newPercentage, isGreater, steps, stepDuration;

            this._value = Math.min(this._maxValue, Math.max(0, value));

            if (!duration) {//No duration, we can't skip the animation
                this._setPercentage(this.getPercent());
                return this;
            }

            newPercentage = self.getPercent();
            isGreater = newPercentage > oldPercentage;

            delta += newPercentage % 1; //If new percentage is not an integer, we add the decimal part to the delta
            steps = Math.floor(Math.abs(newPercentage - oldPercentage) / delta);
            stepDuration = duration / steps;


            (function animate(lastFrame) {
                if (isGreater)
                    oldPercentage += delta;
                else
                    oldPercentage -= delta;

                if ((isGreater && oldPercentage >= newPercentage) || (!isGreater && oldPercentage <= newPercentage)) {
                    requestAnimFrame(function () {
                        self._setPercentage(newPercentage);
                    });
                    return;
                }

                requestAnimFrame(function () {
                    self._setPercentage(oldPercentage);
                });

                var now = Date.now(),
                    deltaTime = now - lastFrame;

                if (deltaTime >= stepDuration) {
                    animate(now);
                } else {
                    setTimeout(function () {
                        animate(Date.now());
                    }, stepDuration - deltaTime);
                }

            })(Date.now());

            return this;
        }
    };

    Circles.create = function (options) {
        return new Circles(options);
    };
})();

/* Modernizr 2.6.2 (Custom Build) | MIT & BSD
 * Build: http://modernizr.com/download/#-fontface-backgroundsize-borderimage-borderradius-boxshadow-flexbox-hsla-multiplebgs-opacity-rgba-textshadow-cssanimations-csscolumns-generatedcontent-cssgradients-cssreflections-csstransforms-csstransforms3d-csstransitions-applicationcache-canvas-canvastext-draganddrop-hashchange-history-audio-video-indexeddb-input-inputtypes-localstorage-postmessage-sessionstorage-websockets-websqldatabase-webworkers-geolocation-inlinesvg-smil-svg-svgclippaths-touch-webgl-shiv-cssclasses-addtest-prefixed-teststyles-testprop-testallprops-hasevent-prefixes-domprefixes-load
 */
;


window.Modernizr = (function (window, document, undefined) {

    var version = '2.6.2',

        Modernizr = {},

        enableClasses = true,

        docElement = document.documentElement,

        mod = 'modernizr',
        modElem = document.createElement(mod),
        mStyle = modElem.style,

        inputElem = document.createElement('input'),

        smile = ':)',

        toString = {}.toString,

        prefixes = ' -webkit- -moz- -o- -ms- '.split(' '),


        omPrefixes = 'Webkit Moz O ms',

        cssomPrefixes = omPrefixes.split(' '),

        domPrefixes = omPrefixes.toLowerCase().split(' '),

        ns = {'svg': 'http://www.w3.org/2000/svg'},

        tests = {},
        inputs = {},
        attrs = {},

        classes = [],

        slice = classes.slice,

        featureName,


        injectElementWithStyles = function (rule, callback, nodes, testnames) {

            var style, ret, node, docOverflow,
                div = document.createElement('div'),
                body = document.body,
                fakeBody = body || document.createElement('body');

            if (parseInt(nodes, 10)) {
                while (nodes--) {
                    node = document.createElement('div');
                    node.id = testnames ? testnames[nodes] : mod + (nodes + 1);
                    div.appendChild(node);
                }
            }

            style = ['&#173;', '<style id="s', mod, '">', rule, '</style>'].join('');
            div.id = mod;
            (body ? div : fakeBody).innerHTML += style;
            fakeBody.appendChild(div);
            if (!body) {
                fakeBody.style.background = '';
                fakeBody.style.overflow = 'hidden';
                docOverflow = docElement.style.overflow;
                docElement.style.overflow = 'hidden';
                docElement.appendChild(fakeBody);
            }

            ret = callback(div, rule);
            if (!body) {
                fakeBody.parentNode.removeChild(fakeBody);
                docElement.style.overflow = docOverflow;
            } else {
                div.parentNode.removeChild(div);
            }

            return !!ret;

        },


        isEventSupported = (function () {

            var TAGNAMES = {
                'select': 'input', 'change': 'input',
                'submit': 'form', 'reset': 'form',
                'error': 'img', 'load': 'img', 'abort': 'img'
            };

            function isEventSupported(eventName, element) {

                element = element || document.createElement(TAGNAMES[eventName] || 'div');
                eventName = 'on' + eventName;

                var isSupported = eventName in element;

                if (!isSupported) {
                    if (!element.setAttribute) {
                        element = document.createElement('div');
                    }
                    if (element.setAttribute && element.removeAttribute) {
                        element.setAttribute(eventName, '');
                        isSupported = is(element[eventName], 'function');

                        if (!is(element[eventName], 'undefined')) {
                            element[eventName] = undefined;
                        }
                        element.removeAttribute(eventName);
                    }
                }

                element = null;
                return isSupported;
            }

            return isEventSupported;
        })(),


        _hasOwnProperty = ({}).hasOwnProperty, hasOwnProp;

    if (!is(_hasOwnProperty, 'undefined') && !is(_hasOwnProperty.call, 'undefined')) {
        hasOwnProp = function (object, property) {
            return _hasOwnProperty.call(object, property);
        };
    }
    else {
        hasOwnProp = function (object, property) {
            return ((property in object) && is(object.constructor.prototype[property], 'undefined'));
        };
    }


    if (!Function.prototype.bind) {
        Function.prototype.bind = function bind(that) {

            var target = this;

            if (typeof target != "function") {
                throw new TypeError();
            }

            var args = slice.call(arguments, 1),
                bound = function () {

                    if (this instanceof bound) {

                        var F = function () {
                        };
                        F.prototype = target.prototype;
                        var self = new F();

                        var result = target.apply(
                            self,
                            args.concat(slice.call(arguments))
                        );
                        if (Object(result) === result) {
                            return result;
                        }
                        return self;

                    } else {

                        return target.apply(
                            that,
                            args.concat(slice.call(arguments))
                        );

                    }

                };

            return bound;
        };
    }

    function setCss(str) {
        mStyle.cssText = str;
    }

    function setCssAll(str1, str2) {
        return setCss(prefixes.join(str1 + ';') + ( str2 || '' ));
    }

    function is(obj, type) {
        return typeof obj === type;
    }

    function contains(str, substr) {
        return !!~('' + str).indexOf(substr);
    }

    function testProps(props, prefixed) {
        for (var i in props) {
            var prop = props[i];
            if (!contains(prop, "-") && mStyle[prop] !== undefined) {
                return prefixed == 'pfx' ? prop : true;
            }
        }
        return false;
    }

    function testDOMProps(props, obj, elem) {
        for (var i in props) {
            var item = obj[props[i]];
            if (item !== undefined) {

                if (elem === false) return props[i];

                if (is(item, 'function')) {
                    return item.bind(elem || obj);
                }

                return item;
            }
        }
        return false;
    }

    function testPropsAll(prop, prefixed, elem) {

        var ucProp = prop.charAt(0).toUpperCase() + prop.slice(1),
            props = (prop + ' ' + cssomPrefixes.join(ucProp + ' ') + ucProp).split(' ');

        if (is(prefixed, "string") || is(prefixed, "undefined")) {
            return testProps(props, prefixed);

        } else {
            props = (prop + ' ' + (domPrefixes).join(ucProp + ' ') + ucProp).split(' ');
            return testDOMProps(props, prefixed, elem);
        }
    }

    tests['flexbox'] = function () {
        return testPropsAll('flexWrap');
    };
    tests['canvas'] = function () {
        var elem = document.createElement('canvas');
        return !!(elem.getContext && elem.getContext('2d'));
    };

    tests['canvastext'] = function () {
        return !!(Modernizr['canvas'] && is(document.createElement('canvas').getContext('2d').fillText, 'function'));
    };


    tests['webgl'] = function () {
        return !!window.WebGLRenderingContext;
    };


    tests['touch'] = function () {
        var bool;

        if (('ontouchstart' in window) || window.DocumentTouch && document instanceof DocumentTouch) {
            bool = true;
        } else {
            injectElementWithStyles(['@media screen and (', prefixes.join('touch-enabled),('), mod, ')', '{#modernizr{top:9px;position:absolute}}'].join(''), function (node) {
                bool = node.offsetTop === 9;
            });
        }

        return bool;
    };


    tests['geolocation'] = function () {
        return 'geolocation' in navigator;
    };


    tests['postmessage'] = function () {
        return !!window.postMessage;
    };


    tests['websqldatabase'] = function () {
        return !!window.openDatabase;
    };

    tests['indexedDB'] = function () {
        return !!testPropsAll("indexedDB", window);
    };

    tests['hashchange'] = function () {
        return isEventSupported('hashchange', window) && (document.documentMode === undefined || document.documentMode > 7);
    };

    tests['history'] = function () {
        return !!(window.history && history.pushState);
    };

    tests['draganddrop'] = function () {
        var div = document.createElement('div');
        return ('draggable' in div) || ('ondragstart' in div && 'ondrop' in div);
    };

    tests['websockets'] = function () {
        return 'WebSocket' in window || 'MozWebSocket' in window;
    };


    tests['rgba'] = function () {
        setCss('background-color:rgba(150,255,150,.5)');

        return contains(mStyle.backgroundColor, 'rgba');
    };

    tests['hsla'] = function () {
        setCss('background-color:hsla(120,40%,100%,.5)');

        return contains(mStyle.backgroundColor, 'rgba') || contains(mStyle.backgroundColor, 'hsla');
    };

    tests['multiplebgs'] = function () {
        setCss('background:url(https://),url(https://),red url(https://)');

        return (/(url\s*\(.*?){3}/).test(mStyle.background);
    };
    tests['backgroundsize'] = function () {
        return testPropsAll('backgroundSize');
    };

    tests['borderimage'] = function () {
        return testPropsAll('borderImage');
    };


    tests['borderradius'] = function () {
        return testPropsAll('borderRadius');
    };

    tests['boxshadow'] = function () {
        return testPropsAll('boxShadow');
    };

    tests['textshadow'] = function () {
        return document.createElement('div').style.textShadow === '';
    };


    tests['opacity'] = function () {
        setCssAll('opacity:.55');

        return (/^0.55$/).test(mStyle.opacity);
    };


    tests['cssanimations'] = function () {
        return testPropsAll('animationName');
    };


    tests['csscolumns'] = function () {
        return testPropsAll('columnCount');
    };


    tests['cssgradients'] = function () {
        var str1 = 'background-image:',
            str2 = 'gradient(linear,left top,right bottom,from(#9f9),to(white));',
            str3 = 'linear-gradient(left top,#9f9, white);';

        setCss(
            (str1 + '-webkit- '.split(' ').join(str2 + str1) +
            prefixes.join(str3 + str1)).slice(0, -str1.length)
        );

        return contains(mStyle.backgroundImage, 'gradient');
    };


    tests['cssreflections'] = function () {
        return testPropsAll('boxReflect');
    };


    tests['csstransforms'] = function () {
        return !!testPropsAll('transform');
    };


    tests['csstransforms3d'] = function () {

        var ret = !!testPropsAll('perspective');

        if (ret && 'webkitPerspective' in docElement.style) {

            injectElementWithStyles('@media screen and (transform-3d),(-webkit-transform-3d){#modernizr{left:9px;position:absolute;height:3px;}}', function (node, rule) {
                ret = node.offsetLeft === 9 && node.offsetHeight === 3;
            });
        }
        return ret;
    };


    tests['csstransitions'] = function () {
        return testPropsAll('transition');
    };


    tests['fontface'] = function () {
        var bool;

        injectElementWithStyles('@font-face {font-family:"font";src:url("https://")}', function (node, rule) {
            var style = document.getElementById('smodernizr'),
                sheet = style.sheet || style.styleSheet,
                cssText = sheet ? (sheet.cssRules && sheet.cssRules[0] ? sheet.cssRules[0].cssText : sheet.cssText || '') : '';

            bool = /src/i.test(cssText) && cssText.indexOf(rule.split(' ')[0]) === 0;
        });

        return bool;
    };

    tests['generatedcontent'] = function () {
        var bool;

        injectElementWithStyles(['#', mod, '{font:0/0 a}#', mod, ':after{content:"', smile, '";visibility:hidden;font:3px/1 a}'].join(''), function (node) {
            bool = node.offsetHeight >= 3;
        });

        return bool;
    };
    tests['video'] = function () {
        var elem = document.createElement('video'),
            bool = false;

        try {
            if (bool = !!elem.canPlayType) {
                bool = new Boolean(bool);
                bool.ogg = elem.canPlayType('video/ogg; codecs="theora"').replace(/^no$/, '');

                bool.h264 = elem.canPlayType('video/mp4; codecs="avc1.42E01E"').replace(/^no$/, '');

                bool.webm = elem.canPlayType('video/webm; codecs="vp8, vorbis"').replace(/^no$/, '');
            }

        } catch (e) {
        }

        return bool;
    };

    tests['audio'] = function () {
        var elem = document.createElement('audio'),
            bool = false;

        try {
            if (bool = !!elem.canPlayType) {
                bool = new Boolean(bool);
                bool.ogg = elem.canPlayType('audio/ogg; codecs="vorbis"').replace(/^no$/, '');
                bool.mp3 = elem.canPlayType('audio/mpeg;').replace(/^no$/, '');

                bool.wav = elem.canPlayType('audio/wav; codecs="1"').replace(/^no$/, '');
                bool.m4a = ( elem.canPlayType('audio/x-m4a;') ||
                elem.canPlayType('audio/aac;')).replace(/^no$/, '');
            }
        } catch (e) {
        }

        return bool;
    };


    tests['localstorage'] = function () {
        try {
            localStorage.setItem(mod, mod);
            localStorage.removeItem(mod);
            return true;
        } catch (e) {
            return false;
        }
    };

    tests['sessionstorage'] = function () {
        try {
            sessionStorage.setItem(mod, mod);
            sessionStorage.removeItem(mod);
            return true;
        } catch (e) {
            return false;
        }
    };


    tests['webworkers'] = function () {
        return !!window.Worker;
    };


    tests['applicationcache'] = function () {
        return !!window.applicationCache;
    };


    tests['svg'] = function () {
        return !!document.createElementNS && !!document.createElementNS(ns.svg, 'svg').createSVGRect;
    };

    tests['inlinesvg'] = function () {
        var div = document.createElement('div');
        div.innerHTML = '<svg/>';
        return (div.firstChild && div.firstChild.namespaceURI) == ns.svg;
    };

    tests['smil'] = function () {
        return !!document.createElementNS && /SVGAnimate/.test(toString.call(document.createElementNS(ns.svg, 'animate')));
    };


    tests['svgclippaths'] = function () {
        return !!document.createElementNS && /SVGClipPath/.test(toString.call(document.createElementNS(ns.svg, 'clipPath')));
    };

    function webforms() {
        Modernizr['input'] = (function (props) {
            for (var i = 0, len = props.length; i < len; i++) {
                attrs[props[i]] = !!(props[i] in inputElem);
            }
            if (attrs.list) {
                attrs.list = !!(document.createElement('datalist') && window.HTMLDataListElement);
            }
            return attrs;
        })('autocomplete autofocus list placeholder max min multiple pattern required step'.split(' '));
        Modernizr['inputtypes'] = (function (props) {

            for (var i = 0, bool, inputElemType, defaultView, len = props.length; i < len; i++) {

                inputElem.setAttribute('type', inputElemType = props[i]);
                bool = inputElem.type !== 'text';

                if (bool) {

                    inputElem.value = smile;
                    inputElem.style.cssText = 'position:absolute;visibility:hidden;';

                    if (/^range$/.test(inputElemType) && inputElem.style.WebkitAppearance !== undefined) {

                        docElement.appendChild(inputElem);
                        defaultView = document.defaultView;

                        bool = defaultView.getComputedStyle &&
                            defaultView.getComputedStyle(inputElem, null).WebkitAppearance !== 'textfield' &&
                            (inputElem.offsetHeight !== 0);

                        docElement.removeChild(inputElem);

                    } else if (/^(search|tel)$/.test(inputElemType)) {
                    } else if (/^(url|email)$/.test(inputElemType)) {
                        bool = inputElem.checkValidity && inputElem.checkValidity() === false;

                    } else {
                        bool = inputElem.value != smile;
                    }
                }

                inputs[props[i]] = !!bool;
            }
            return inputs;
        })('search tel url email datetime date month week time datetime-local number range color'.split(' '));
    }

    for (var feature in tests) {
        if (hasOwnProp(tests, feature)) {
            featureName = feature.toLowerCase();
            Modernizr[featureName] = tests[feature]();

            classes.push((Modernizr[featureName] ? '' : 'no-') + featureName);
        }
    }

    Modernizr.input || webforms();


    Modernizr.addTest = function (feature, test) {
        if (typeof feature == 'object') {
            for (var key in feature) {
                if (hasOwnProp(feature, key)) {
                    Modernizr.addTest(key, feature[key]);
                }
            }
        } else {

            feature = feature.toLowerCase();

            if (Modernizr[feature] !== undefined) {
                return Modernizr;
            }

            test = typeof test == 'function' ? test() : test;

            if (typeof enableClasses !== "undefined" && enableClasses) {
                docElement.className += ' ' + (test ? '' : 'no-') + feature;
            }
            Modernizr[feature] = test;

        }

        return Modernizr;
    };


    setCss('');
    modElem = inputElem = null;

    ;
    (function (window, document) {
        var options = window.html5 || {};

        var reSkip = /^<|^(?:button|map|select|textarea|object|iframe|option|optgroup)$/i;

        var saveClones = /^(?:a|b|code|div|fieldset|h1|h2|h3|h4|h5|h6|i|label|li|ol|p|q|span|strong|style|table|tbody|td|th|tr|ul)$/i;

        var supportsHtml5Styles;

        var expando = '_html5shiv';

        var expanID = 0;

        var expandoData = {};

        var supportsUnknownElements;

        (function () {
            try {
                var a = document.createElement('a');
                a.innerHTML = '<xyz></xyz>';
                supportsHtml5Styles = ('hidden' in a);

                supportsUnknownElements = a.childNodes.length == 1 || (function () {
                        (document.createElement)('a');
                        var frag = document.createDocumentFragment();
                        return (
                            typeof frag.cloneNode == 'undefined' ||
                            typeof frag.createDocumentFragment == 'undefined' ||
                            typeof frag.createElement == 'undefined'
                        );
                    }());
            } catch (e) {
                supportsHtml5Styles = true;
                supportsUnknownElements = true;
            }

        }());
        function addStyleSheet(ownerDocument, cssText) {
            var p = ownerDocument.createElement('p'),
                parent = ownerDocument.getElementsByTagName('head')[0] || ownerDocument.documentElement;

            p.innerHTML = 'x<style>' + cssText + '</style>';
            return parent.insertBefore(p.lastChild, parent.firstChild);
        }

        function getElements() {
            var elements = html5.elements;
            return typeof elements == 'string' ? elements.split(' ') : elements;
        }

        function getExpandoData(ownerDocument) {
            var data = expandoData[ownerDocument[expando]];
            if (!data) {
                data = {};
                expanID++;
                ownerDocument[expando] = expanID;
                expandoData[expanID] = data;
            }
            return data;
        }

        function createElement(nodeName, ownerDocument, data) {
            if (!ownerDocument) {
                ownerDocument = document;
            }
            if (supportsUnknownElements) {
                return ownerDocument.createElement(nodeName);
            }
            if (!data) {
                data = getExpandoData(ownerDocument);
            }
            var node;

            if (data.cache[nodeName]) {
                node = data.cache[nodeName].cloneNode();
            } else if (saveClones.test(nodeName)) {
                node = (data.cache[nodeName] = data.createElem(nodeName)).cloneNode();
            } else {
                node = data.createElem(nodeName);
            }

            return node.canHaveChildren && !reSkip.test(nodeName) ? data.frag.appendChild(node) : node;
        }

        function createDocumentFragment(ownerDocument, data) {
            if (!ownerDocument) {
                ownerDocument = document;
            }
            if (supportsUnknownElements) {
                return ownerDocument.createDocumentFragment();
            }
            data = data || getExpandoData(ownerDocument);
            var clone = data.frag.cloneNode(),
                i = 0,
                elems = getElements(),
                l = elems.length;
            for (; i < l; i++) {
                clone.createElement(elems[i]);
            }
            return clone;
        }

        function shivMethods(ownerDocument, data) {
            if (!data.cache) {
                data.cache = {};
                data.createElem = ownerDocument.createElement;
                data.createFrag = ownerDocument.createDocumentFragment;
                data.frag = data.createFrag();
            }


            ownerDocument.createElement = function (nodeName) {
                if (!html5.shivMethods) {
                    return data.createElem(nodeName);
                }
                return createElement(nodeName, ownerDocument, data);
            };

            ownerDocument.createDocumentFragment = Function('h,f', 'return function(){' +
                'var n=f.cloneNode(),c=n.createElement;' +
                'h.shivMethods&&(' +
                getElements().join().replace(/\w+/g, function (nodeName) {
                    data.createElem(nodeName);
                    data.frag.createElement(nodeName);
                    return 'c("' + nodeName + '")';
                }) +
                ');return n}'
            )(html5, data.frag);
        }

        function shivDocument(ownerDocument) {
            if (!ownerDocument) {
                ownerDocument = document;
            }
            var data = getExpandoData(ownerDocument);

            if (html5.shivCSS && !supportsHtml5Styles && !data.hasCSS) {
                data.hasCSS = !!addStyleSheet(ownerDocument,
                    'article,aside,figcaption,figure,footer,header,hgroup,nav,section{display:block}' +
                    'mark{background:#FF0;color:#000}'
                );
            }
            if (!supportsUnknownElements) {
                shivMethods(ownerDocument, data);
            }
            return ownerDocument;
        }

        var html5 = {

            'elements': options.elements || 'abbr article aside audio bdi canvas data datalist details figcaption figure footer header hgroup mark meter nav output progress section summary time video',

            'shivCSS': (options.shivCSS !== false),

            'supportsUnknownElements': supportsUnknownElements,

            'shivMethods': (options.shivMethods !== false),

            'type': 'default',

            'shivDocument': shivDocument,

            createElement: createElement,

            createDocumentFragment: createDocumentFragment
        };
        window.html5 = html5;

        shivDocument(document);

    }(this, document));

    Modernizr._version = version;

    Modernizr._prefixes = prefixes;
    Modernizr._domPrefixes = domPrefixes;
    Modernizr._cssomPrefixes = cssomPrefixes;


    Modernizr.hasEvent = isEventSupported;

    Modernizr.testProp = function (prop) {
        return testProps([prop]);
    };

    Modernizr.testAllProps = testPropsAll;


    Modernizr.testStyles = injectElementWithStyles;
    Modernizr.prefixed = function (prop, obj, elem) {
        if (!obj) {
            return testPropsAll(prop, 'pfx');
        } else {
            return testPropsAll(prop, obj, elem);
        }
    };


    docElement.className = docElement.className.replace(/(^|\s)no-js(\s|$)/, '$1$2') +

        (enableClasses ? ' js ' + classes.join(' ') : '');

    return Modernizr;

})(this, this.document);
/*yepnope1.5.4|WTFPL*/
(function (a, b, c) {
    function d(a) {
        return "[object Function]" == o.call(a)
    }

    function e(a) {
        return "string" == typeof a
    }

    function f() {
    }

    function g(a) {
        return !a || "loaded" == a || "complete" == a || "uninitialized" == a
    }

    function h() {
        var a = p.shift();
        q = 1, a ? a.t ? m(function () {
            ("c" == a.t ? B.injectCss : B.injectJs)(a.s, 0, a.a, a.x, a.e, 1)
        }, 0) : (a(), h()) : q = 0
    }

    function i(a, c, d, e, f, i, j) {
        function k(b) {
            if (!o && g(l.readyState) && (u.r = o = 1, !q && h(), l.onload = l.onreadystatechange = null, b)) {
                "img" != a && m(function () {
                    t.removeChild(l)
                }, 50);
                for (var d in y[c])y[c].hasOwnProperty(d) && y[c][d].onload()
            }
        }

        var j = j || B.errorTimeout, l = b.createElement(a), o = 0, r = 0, u = {t: d, s: c, e: f, a: i, x: j};
        1 === y[c] && (r = 1, y[c] = []), "object" == a ? l.data = c : (l.src = c, l.type = a), l.width = l.height = "0", l.onerror = l.onload = l.onreadystatechange = function () {
            k.call(this, r)
        }, p.splice(e, 0, u), "img" != a && (r || 2 === y[c] ? (t.insertBefore(l, s ? null : n), m(k, j)) : y[c].push(l))
    }

    function j(a, b, c, d, f) {
        return q = 0, b = b || "j", e(a) ? i("c" == b ? v : u, a, b, this.i++, c, d, f) : (p.splice(this.i++, 0, a), 1 == p.length && h()), this
    }

    function k() {
        var a = B;
        return a.loader = {load: j, i: 0}, a
    }

    var l = b.documentElement, m = a.setTimeout, n = b.getElementsByTagName("script")[0], o = {}.toString, p = [], q = 0, r = "MozAppearance" in l.style, s = r && !!b.createRange().compareNode, t = s ? l : n.parentNode, l = a.opera && "[object Opera]" == o.call(a.opera), l = !!b.attachEvent && !l, u = r ? "object" : l ? "script" : "img", v = l ? "script" : u, w = Array.isArray || function (a) {
            return "[object Array]" == o.call(a)
        }, x = [], y = {}, z = {
        timeout: function (a, b) {
            return b.length && (a.timeout = b[0]), a
        }
    }, A, B;
    B = function (a) {
        function b(a) {
            var a = a.split("!"), b = x.length, c = a.pop(), d = a.length, c = {
                url: c,
                origUrl: c,
                prefixes: a
            }, e, f, g;
            for (f = 0; f < d; f++)g = a[f].split("="), (e = z[g.shift()]) && (c = e(c, g));
            for (f = 0; f < b; f++)c = x[f](c);
            return c
        }

        function g(a, e, f, g, h) {
            var i = b(a), j = i.autoCallback;
            i.url.split(".").pop().split("?").shift(), i.bypass || (e && (e = d(e) ? e : e[a] || e[g] || e[a.split("/").pop().split("?")[0]]), i.instead ? i.instead(a, e, f, g, h) : (y[i.url] ? i.noexec = !0 : y[i.url] = 1, f.load(i.url, i.forceCSS || !i.forceJS && "css" == i.url.split(".").pop().split("?").shift() ? "c" : c, i.noexec, i.attrs, i.timeout), (d(e) || d(j)) && f.load(function () {
                k(), e && e(i.origUrl, h, g), j && j(i.origUrl, h, g), y[i.url] = 2
            })))
        }

        function h(a, b) {
            function c(a, c) {
                if (a) {
                    if (e(a))c || (j = function () {
                        var a = [].slice.call(arguments);
                        k.apply(this, a), l()
                    }), g(a, j, b, 0, h); else if (Object(a) === a)for (n in m = function () {
                        var b = 0, c;
                        for (c in a)a.hasOwnProperty(c) && b++;
                        return b
                    }(), a)a.hasOwnProperty(n) && (!c && !--m && (d(j) ? j = function () {
                        var a = [].slice.call(arguments);
                        k.apply(this, a), l()
                    } : j[n] = function (a) {
                        return function () {
                            var b = [].slice.call(arguments);
                            a && a.apply(this, b), l()
                        }
                    }(k[n])), g(a[n], j, b, n, h))
                } else!c && l()
            }

            var h = !!a.test, i = a.load || a.both, j = a.callback || f, k = j, l = a.complete || f, m, n;
            c(h ? a.yep : a.nope, !!i), i && c(i)
        }

        var i, j, l = this.yepnope.loader;
        if (e(a))g(a, 0, l, 0); else if (w(a))for (i = 0; i < a.length; i++)j = a[i], e(j) ? g(j, 0, l, 0) : w(j) ? B(j) : Object(j) === j && h(j, l); else Object(a) === a && h(a, l)
    }, B.addPrefix = function (a, b) {
        z[a] = b
    }, B.addFilter = function (a) {
        x.push(a)
    }, B.errorTimeout = 1e4, null == b.readyState && b.addEventListener && (b.readyState = "loading", b.addEventListener("DOMContentLoaded", A = function () {
        b.removeEventListener("DOMContentLoaded", A, 0), b.readyState = "complete"
    }, 0)), a.yepnope = k(), a.yepnope.executeStack = h, a.yepnope.injectJs = function (a, c, d, e, i, j) {
        var k = b.createElement("script"), l, o, e = e || B.errorTimeout;
        k.src = a;
        for (o in d)k.setAttribute(o, d[o]);
        c = j ? h : c || f, k.onreadystatechange = k.onload = function () {
            !l && g(k.readyState) && (l = 1, c(), k.onload = k.onreadystatechange = null)
        }, m(function () {
            l || (l = 1, c(1))
        }, e), i ? k.onload() : n.parentNode.insertBefore(k, n)
    }, a.yepnope.injectCss = function (a, c, d, e, g, i) {
        var e = b.createElement("link"), j, c = i ? h : c || f;
        e.href = a, e.rel = "stylesheet", e.type = "text/css";
        for (j in d)e.setAttribute(j, d[j]);
        g || (n.parentNode.insertBefore(e, n), m(c, 0))
    }
})(this, document);
Modernizr.load = function () {
    yepnope.apply(window, [].slice.call(arguments, 0));
};
;
/*!
 * parallax.js v1.4.2 (http://pixelcog.github.io/parallax.js/)
 * @copyright 2016 PixelCog, Inc.
 * @license MIT (https://github.com/pixelcog/parallax.js/blob/master/LICENSE)
 */

;(function ($, window, document, undefined) {

    // Polyfill for requestAnimationFrame
    // via: https://gist.github.com/paulirish/1579671

    (function () {
        var lastTime = 0;
        var vendors = ['ms', 'moz', 'webkit', 'o'];
        for (var x = 0; x < vendors.length && !window.requestAnimationFrame; ++x) {
            window.requestAnimationFrame = window[vendors[x] + 'RequestAnimationFrame'];
            window.cancelAnimationFrame = window[vendors[x] + 'CancelAnimationFrame']
                || window[vendors[x] + 'CancelRequestAnimationFrame'];
        }

        if (!window.requestAnimationFrame)
            window.requestAnimationFrame = function (callback) {
                var currTime = new Date().getTime();
                var timeToCall = Math.max(0, 16 - (currTime - lastTime));
                var id = window.setTimeout(function () {
                        callback(currTime + timeToCall);
                    },
                    timeToCall);
                lastTime = currTime + timeToCall;
                return id;
            };

        if (!window.cancelAnimationFrame)
            window.cancelAnimationFrame = function (id) {
                clearTimeout(id);
            };
    }());


    // Parallax Constructor

    function Parallax(element, options) {
        var self = this;

        if (typeof options == 'object') {
            delete options.refresh;
            delete options.render;
            $.extend(this, options);
        }

        this.$element = $(element);

        if (!this.imageSrc && this.$element.is('img')) {
            this.imageSrc = this.$element.attr('src');
        }

        var positions = (this.position + '').toLowerCase().match(/\S+/g) || [];

        if (positions.length < 1) {
            positions.push('center');
        }
        if (positions.length == 1) {
            positions.push(positions[0]);
        }

        if (positions[0] == 'top' || positions[0] == 'bottom' || positions[1] == 'left' || positions[1] == 'right') {
            positions = [positions[1], positions[0]];
        }

        if (this.positionX != undefined) positions[0] = this.positionX.toLowerCase();
        if (this.positionY != undefined) positions[1] = this.positionY.toLowerCase();

        self.positionX = positions[0];
        self.positionY = positions[1];

        if (this.positionX != 'left' && this.positionX != 'right') {
            if (isNaN(parseInt(this.positionX))) {
                this.positionX = 'center';
            } else {
                this.positionX = parseInt(this.positionX);
            }
        }

        if (this.positionY != 'top' && this.positionY != 'bottom') {
            if (isNaN(parseInt(this.positionY))) {
                this.positionY = 'center';
            } else {
                this.positionY = parseInt(this.positionY);
            }
        }

        this.position =
            this.positionX + (isNaN(this.positionX) ? '' : 'px') + ' ' +
            this.positionY + (isNaN(this.positionY) ? '' : 'px');

        if (navigator.userAgent.match(/(iPod|iPhone|iPad)/)) {
            if (this.imageSrc && this.iosFix && !this.$element.is('img')) {
                this.$element.css({
                    backgroundImage: 'url(' + this.imageSrc + ')',
                    backgroundSize: 'cover',
                    backgroundPosition: this.position
                });
            }
            return this;
        }

        if (navigator.userAgent.match(/(Android)/)) {
            if (this.imageSrc && this.androidFix && !this.$element.is('img')) {
                this.$element.css({
                    backgroundImage: 'url(' + this.imageSrc + ')',
                    backgroundSize: 'cover',
                    backgroundPosition: this.position
                });
            }
            return this;
        }

        this.$mirror = $('<div />').prependTo('body');

        var slider = this.$element.find('>.parallax-slider');
        var sliderExisted = false;

        if (slider.length == 0)
            this.$slider = $('<img />').prependTo(this.$mirror);
        else {
            this.$slider = slider.prependTo(this.$mirror)
            sliderExisted = true;
        }

        this.$mirror.addClass('parallax-mirror').css({
            visibility: 'hidden',
            zIndex: this.zIndex,
            position: 'fixed',
            top: 0,
            left: 0,
            overflow: 'hidden'
        });

        this.$slider.addClass('parallax-slider').one('load', function () {
            if (!self.naturalHeight || !self.naturalWidth) {
                self.naturalHeight = this.naturalHeight || this.height || 1;
                self.naturalWidth = this.naturalWidth || this.width || 1;
            }
            self.aspectRatio = self.naturalWidth / self.naturalHeight;

            Parallax.isSetup || Parallax.setup();
            Parallax.sliders.push(self);
            Parallax.isFresh = false;
            Parallax.requestRender();
        });

        if (!sliderExisted)
            this.$slider[0].src = this.imageSrc;

        if (this.naturalHeight && this.naturalWidth || this.$slider[0].complete || slider.length > 0) {
            this.$slider.trigger('load');
        }

    };


    // Parallax Instance Methods

    $.extend(Parallax.prototype, {
        speed: 0.2,
        bleed: 0,
        zIndex: -100,
        iosFix: true,
        androidFix: true,
        position: 'center',
        overScrollFix: false,

        refresh: function () {
            this.boxWidth = this.$element.outerWidth();
            this.boxHeight = this.$element.outerHeight() + this.bleed * 2;
            this.boxOffsetTop = this.$element.offset().top - this.bleed;
            this.boxOffsetLeft = this.$element.offset().left;
            this.boxOffsetBottom = this.boxOffsetTop + this.boxHeight;

            var winHeight = Parallax.winHeight;
            var docHeight = Parallax.docHeight;
            var maxOffset = Math.min(this.boxOffsetTop, docHeight - winHeight);
            var minOffset = Math.max(this.boxOffsetTop + this.boxHeight - winHeight, 0);
            var imageHeightMin = this.boxHeight + (maxOffset - minOffset) * (1 - this.speed) | 0;
            var imageOffsetMin = (this.boxOffsetTop - maxOffset) * (1 - this.speed) | 0;

            if (imageHeightMin * this.aspectRatio >= this.boxWidth) {
                this.imageWidth = imageHeightMin * this.aspectRatio | 0;
                this.imageHeight = imageHeightMin;
                this.offsetBaseTop = imageOffsetMin;

                var margin = this.imageWidth - this.boxWidth;

                if (this.positionX == 'left') {
                    this.offsetLeft = 0;
                } else if (this.positionX == 'right') {
                    this.offsetLeft = -margin;
                } else if (!isNaN(this.positionX)) {
                    this.offsetLeft = Math.max(this.positionX, -margin);
                } else {
                    this.offsetLeft = -margin / 2 | 0;
                }
            } else {
                this.imageWidth = this.boxWidth;
                this.imageHeight = this.boxWidth / this.aspectRatio | 0;
                this.offsetLeft = 0;

                var margin = this.imageHeight - imageHeightMin;

                if (this.positionY == 'top') {
                    this.offsetBaseTop = imageOffsetMin;
                } else if (this.positionY == 'bottom') {
                    this.offsetBaseTop = imageOffsetMin - margin;
                } else if (!isNaN(this.positionY)) {
                    this.offsetBaseTop = imageOffsetMin + Math.max(this.positionY, -margin);
                } else {
                    this.offsetBaseTop = imageOffsetMin - margin / 2 | 0;
                }
            }
        },

        render: function () {
            var scrollTop = Parallax.scrollTop;
            var scrollLeft = Parallax.scrollLeft;
            var overScroll = this.overScrollFix ? Parallax.overScroll : 0;
            var scrollBottom = scrollTop + Parallax.winHeight;

            if (this.boxOffsetBottom > scrollTop && this.boxOffsetTop <= scrollBottom) {
                this.visibility = 'visible';
                this.mirrorTop = this.boxOffsetTop - scrollTop;
                this.mirrorLeft = this.boxOffsetLeft - scrollLeft;
                this.offsetTop = this.offsetBaseTop - this.mirrorTop * (1 - this.speed);
            } else {
                this.visibility = 'hidden';
            }

            this.$mirror.css({
                transform: 'translate3d(0px, 0px, 0px)',
                visibility: this.visibility,
                top: this.mirrorTop - overScroll,
                left: this.mirrorLeft,
                height: this.boxHeight,
                width: this.boxWidth
            });

            this.$slider.css({
                transform: 'translate3d(0px, 0px, 0px)',
                position: 'absolute',
                top: this.offsetTop,
                left: this.offsetLeft,
                height: this.imageHeight,
                width: this.imageWidth,
                maxWidth: 'none'
            });
        }
    });


    // Parallax Static Methods

    $.extend(Parallax, {
        scrollTop: 0,
        scrollLeft: 0,
        winHeight: 0,
        winWidth: 0,
        docHeight: 1 << 30,
        docWidth: 1 << 30,
        sliders: [],
        isReady: false,
        isFresh: false,
        isBusy: false,

        setup: function () {
            if (this.isReady) return;

            var $doc = $(document), $win = $(window);

            var loadDimensions = function () {
                Parallax.winHeight = $win.height();
                Parallax.winWidth = $win.width();
                Parallax.docHeight = $doc.height();
                Parallax.docWidth = $doc.width();
            };

            var loadScrollPosition = function () {
                var winScrollTop = $win.scrollTop();
                var scrollTopMax = Parallax.docHeight - Parallax.winHeight;
                var scrollLeftMax = Parallax.docWidth - Parallax.winWidth;
                Parallax.scrollTop = Math.max(0, Math.min(scrollTopMax, winScrollTop));
                Parallax.scrollLeft = Math.max(0, Math.min(scrollLeftMax, $win.scrollLeft()));
                Parallax.overScroll = Math.max(winScrollTop - scrollTopMax, Math.min(winScrollTop, 0));
            };

            $win.on('resize.px.parallax load.px.parallax', function () {
                    loadDimensions();
                    Parallax.isFresh = false;
                    Parallax.requestRender();
                })
                .on('scroll.px.parallax load.px.parallax', function () {
                    loadScrollPosition();
                    Parallax.requestRender();
                });

            loadDimensions();
            loadScrollPosition();

            this.isReady = true;
        },

        configure: function (options) {
            if (typeof options == 'object') {
                delete options.refresh;
                delete options.render;
                $.extend(this.prototype, options);
            }
        },

        refresh: function () {
            $.each(this.sliders, function () {
                this.refresh()
            });
            this.isFresh = true;
        },

        render: function () {
            this.isFresh || this.refresh();
            $.each(this.sliders, function () {
                this.render()
            });
        },

        requestRender: function () {
            var self = this;

            if (!this.isBusy) {
                this.isBusy = true;
                window.requestAnimationFrame(function () {
                    self.render();
                    self.isBusy = false;
                });
            }
        },
        destroy: function (el) {
            var i,
                parallaxElement = $(el).data('px.parallax');
            parallaxElement.$mirror.remove();
            for (i = 0; i < this.sliders.length; i += 1) {
                if (this.sliders[i] == parallaxElement) {
                    this.sliders.splice(i, 1);
                }
            }
            $(el).data('px.parallax', false);
            if (this.sliders.length === 0) {
                $(window).off('scroll.px.parallax resize.px.parallax load.px.parallax');
                this.isReady = false;
                Parallax.isSetup = false;
            }
        }
    });

    /**
     * Atualização do Gráfico por Situação e atividade
     */

    (function ($) {
        atualizaProjetosSituacaoAtividade = function (associada, situacao, atividade, grafico) {
            $.ajax({
                url: '/' + $('#app_locale').val() + '/projetos-situacao-atividade',
                data: {associada: associada, situacao: situacao, atividade: atividade},
                dataType: 'json',
                beforeSend: function () {
                    $("#" + grafico).empty();
                },
                success: function (data, status) {
                    if (data == 0) {
                        $('#' + grafico).html("<p style='text-align:center;margin-top:25%'>Não foi encontrado nenhum registro</p>");
                    } else {
                        createLineChart({
                            id: grafico,
                            data_file: data
                        });
                    }

                }
            });
        }
    })(jQuery);

    /**
     * Gerar gráfico full de barras por projetos x associadas x situação
     * Projetos em números
     */
    (function ($) {
        createGraphicfull = function (dataset) {
            var margin = {
                    top: 30,
                    right: 30,
                    bottom: 30,
                    left: (parseInt(d3.select('#graphicfull').style('width'), 10) / 20)
                },
                width = parseInt(d3.select('#graphicfull').style('width'), 10) - margin.left - margin.right,
                height = parseInt(d3.select('#graphicfull').style('height')) - margin.top - margin.bottom;

            var x0 = d3.scale.ordinal()
                .rangeRoundBands([0, width], .5);

            var x1 = d3.scale.ordinal();

            var y = d3.scale.linear()
                .range([height, 0]);

            var colorRange = (d3.scale.category20());
            var color = d3.scale.ordinal()
                .range(colorRange.range());
            var data_color = function (data_name) {
                var all_colors = [];
                all_colors['Em andamento'] = '#7e8ab8';
                all_colors['Em análise'] = '#a19e6c';
                all_colors['Encerrado'] = '#8b757e';
                all_colors['Cancelado'] = '#d19986';

                return all_colors[data_name];
            };

            var xAxis = d3.svg.axis()
                .scale(x0)
                .orient("bottom");

            var yAxis = d3.svg.axis()
                .scale(y)
                .orient("left")
                .tickFormat(d3.format("1s"));

            var yAxisLines = d3.svg.axis()
                .scale(y)
                .orient("left")
                .innerTickSize(-width)
                .outerTickSize(0)
                .tickPadding(10);

            var divTooltip = d3.select("#graphicfull").append("div").attr("class", "toolTip");
            divTooltip.style("background", '#d19986');
            divTooltip.style("color", '#fff');


            var svg = d3.select("#graphicfull").append("svg")
                .attr("width", width + margin.left + margin.right)
                .attr("height", height + margin.top + margin.bottom)
                .append("g")
                .attr("transform", "translate(" + margin.left + "," + margin.top + ")");

            var options = d3.keys(dataset[0]).filter(function (key) {
                return key !== "label";
            });

            dataset.forEach(function (d) {
                d.valores = options.map(function (name) {
                    return {name: name, value: +d[name]};
                });
            });

            x0.domain(dataset.map(function (d) {
                return d.label;
            }));
            x1.domain(options).rangeRoundBands([0, x0.rangeBand()]);
            y.domain([0, d3.max(dataset, function (d) {
                return d3.max(d.valores, function (d) {
                    return d.value;
                });
            })]);

            svg.append("g")
                .attr("class", "x axis")
                .attr("transform", "translate(0," + height + ")")
                .call(xAxis);

            svg.append("g")
                .attr("class", "y axis")
                .call(yAxis)
                .append("text")
                .attr("transform", "rotate(-90)")
                .attr("y", 6)
                .attr("dy", ".71em")
                .style("text-anchor", "end")
                .text("Porcentagem");

            svg.append("g")
                .attr("class", "y axis axis-lines")
                .call(yAxisLines);


            var bar = svg.selectAll(".bar")
                .data(dataset)
                .enter().append("g")
                .attr("class", "rect")
                .attr("transform", function (d) {
                    return "translate(" + x0(d.label) + ",0)";
                });

            bar.selectAll("rect")
                .data(function (d) {
                    return d.valores;
                })
                .enter().append("rect")
                .attr("width", x1.rangeBand())
                .attr("x", function (d) {
                    return x1(d.name);
                })
                .attr("y", function (d) {
                    return y(d.value);
                })
                .attr("value", function (d) {
                    return d.name;
                })
                .attr("height", function (d) {
                    return height - y(d.value);
                })
                .style("fill", function (d) {
                    return data_color(d.name);
                });

            bar
                .on("mousemove", function (d) {
                    divTooltip.style("left", d3.event.layerX + 10 + "px");
                    divTooltip.style("top", d3.event.layerY - 25 + "px");
                    divTooltip.style("display", "inline-block");
                    var x = d3.event.pageX, y = d3.event.pageY
                    var elements = document.querySelectorAll(':hover');
                    l = elements.length
                    l = l - 1
                    elementData = elements[l].__data__
                    divTooltip.html((d.label) + "<br>" + elementData.name + "<br>" + elementData.value + "%");
                });
            bar
                .on("mouseout", function (d) {
                    divTooltip.style("display", "none");
                });


            var legend = svg.selectAll(".legend")
                .data(options.slice())
                .enter().append("g")
                .attr("class", "legend")
                .attr("transform", function (d, i) {
                    return "translate(0," + i * 20 + ")";
                });

            legend.append("rect")
                .attr("x", width - 18)
                .attr("width", 18)
                .attr("height", 18)
                .style("fill", data_color);

            legend.append("text")
                .attr("x", width - 24)
                .attr("y", 9)
                .attr("dy", ".35em")
                .style("text-anchor", "end")
                .text(function (d) {
                    return d;
                });
        }
    })(jQuery);

    /**
     * Atualizar gráficos de projetos x situação
     */
    (function ($) {
        atualizaProjetoSituacao = function () {
            var associada = $('#projetos_situacao_associada').val();
            var situacao = $('#projetos_situacao').val();
            var atividade = 0;
            var grafico = 'graphic';
            atualizaProjetosSituacaoAtividade(associada, situacao, atividade, grafico);
        }
    })(jQuery);

    /**
     * Atualiza gráficos de projetos x atividade
     */
    (function ($) {
        atualizaProjetoAtividade = function (grafico) {
            var associada = $('#projetos_atividades_associada').val();
            var situacao = 0
            var atividade = $('#projetos_atividades_atividade').val();
            var grafico = grafico;
            atualizaProjetosSituacaoAtividade(associada, situacao, atividade, grafico);
        }
    })(jQuery);

    (function ($) {
        selectSubNavbar = function (item) {
            //Menos 1 para ficar mais amigável (começa em 0)
            item--;

            $('.sub-navbar li a').removeClass('active');
            //Ativar o link informado
            $(".sub-navbar").each(function (index) {
                $(this).find("a:eq(" + item + ")").addClass('active');
            });
        }
    })(jQuery);


    // Parallax Plugin Definition

    function Plugin(option) {
        return this.each(function () {
            var $this = $(this);
            var options = typeof option == 'object' && option;

            if (this == window || this == document || $this.is('body')) {
                Parallax.configure(options);
            }
            else if (!$this.data('px.parallax')) {
                options = $.extend({}, $this.data(), options);
                $this.data('px.parallax', new Parallax(this, options));
            }
            else if (typeof option == 'object') {
                $.extend($this.data('px.parallax'), options);
            }
            if (typeof option == 'string') {
                if (option == 'destroy') {
                    Parallax['destroy'](this);
                } else {
                    Parallax[option]();
                }
            }
        })
    };

    var old = $.fn.parallax;

    $.fn.parallax = Plugin;
    $.fn.parallax.Constructor = Parallax;


    // Parallax No Conflict

    $.fn.parallax.noConflict = function () {
        $.fn.parallax = old;
        return this;
    };


    // Parallax Data-API

    $(document).on('ready.px.parallax.data-api', function () {
        $('[data-parallax="scroll"]').parallax();
    });

}(jQuery, window, document));
