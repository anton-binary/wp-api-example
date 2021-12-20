<?php

function TradingView_content() {
    $chart_container = "";
    if(is_page('tradingview-chart')) {
        $chart_container = <<<chart_container
        <div class="controls">
            <select id="active_symbols" onchange="switch_symbol(this)"></select>
            <label class="button">
                <input type="radio" value="0" name="timeframe" onchange="switch_timeframe(this)" checked>
                <span class="checkmark">1 t</span>
            </label>
            <label class="button">
                <input type="radio" value="60" name="timeframe" onchange="switch_timeframe(this)">
                <span class="checkmark">1 m</span>
            </label>
            <label class="button">
                <input type="radio" value="300" name="timeframe" onchange="switch_timeframe(this)">
                <span class="checkmark">5 m</span>
            </label>
            <label class="button">
                <input type="radio" value="900" name="timeframe" onchange="switch_timeframe(this)">
                <span class="checkmark">15 m</span>
            </label>
            <label class="button">
                <input type="radio" value="1800" name="timeframe" onchange="switch_timeframe(this)">
                <span class="checkmark">30 m</span>
            </label>
            <label class="button">
                <input type="radio" value="3600" name="timeframe" onchange="switch_timeframe(this)">
                <span class="checkmark">1 h</span>
            </label>
            <label class="button">
                <input type="radio" value="86400" name="timeframe" onchange="switch_timeframe(this)">
                <span class="checkmark">1 d</span>
            </label>
        </div>
        <div id="chart_container" style="width: 100%; height: 400px"></div>
        chart_container;
    }
    return $chart_container;
}

function TradingView_js_head() {
    $plugins_dir = plugins_url();
    if(is_page('tradingview-chart')) { 
        ?>
            <script src="https://unpkg.com/lightweight-charts/dist/lightweight-charts.standalone.production.js"></script>
            <script src="https://unpkg.com/@deriv/deriv-api@1.0.9/dist/DerivAPIBasic.js"></script>
            <script src="<?=$plugins_dir?>/wp-api-example/js/tradingview.js"></script>
            <link rel="stylesheet" href="<?=$plugins_dir?>/wp-api-example/css/tradingview.css" type="text/css" media="all">
        <?php
    }    
}

function TradingView_js_footer() {
    if(is_page('tradingview-chart')) { 
    ?>
            <script>

                init({ 
                    container_id: 'chart_container', 
                    symbol: 'R_100',
                    style: "ticks"
                });

                get_active_symbols({ 
                    selected_symbol: 'R_100' 
                }).then(r => {
                    document.getElementById('active_symbols').innerHTML = r.map(s => {
                        return '<option id="' + s.symbol + '"' + (s.selected_symbol ? ' selected ' : '') + '>' + s.display_name + '</option>'; 
                    }).join("");
                });

                const switch_timeframe = (timeframe) => {
                    const select = document.getElementById('active_symbols');
                    const active_symbol = select.options[select.options.selectedIndex].id;
                    if(timeframe.value == "0") {
                        init({ container_id: 'chart_container', symbol: active_symbol, style: "ticks"});
                    } else {
                        init({ container_id: 'chart_container', symbol: active_symbol, style: "candles", granularity: timeframe.value });
                    }
                }

                function switch_symbol(active_symbols) {
                    const active_symbol = active_symbols.options[active_symbols.options.selectedIndex].id;
                    const timeframes = document.getElementsByName('timeframe');
                    var granularity;
                    for(var i = 0; i < timeframes.length; i++) {
                        if(timeframes[i].checked) {
                            granularity = timeframes[i].value;
                            break;
                        }                        
                    }
                    if(granularity == "0") {
                        init({ container_id: 'chart_container', symbol: active_symbol, style: "ticks" });
                    } else {
                        init({ container_id: 'chart_container', symbol: active_symbol, style: "candles", granularity: granularity });
                    }
                }

            </script>
    <?php
    }
}