const api = new DerivAPIBasic({ endpoint: 'ws.binaryws.com', app_id: 1089 });
var chart, series, sub_id;

const init = async (args) => {

    args.granularity = args.granularity ? args.granularity : 60;

    if(sub_id) api.forget(sub_id);

    if(series) {
        chart.removeSeries(series);
    } else {
        chart = LightweightCharts.createChart(args.container_id, { 
            width: 0, 
            height: 0,
            timeScale: {
                timeVisible: true,
                secondsVisible: true,
                rightOffset: 20,
                borderColor: "#d6dcde"
            },
            priceScale: {
                borderColor: "#d6dcde",
                autoScale: true
            }
        });
    }
    
    if(args.style == "ticks") {
        series = chart.addAreaSeries({
            topColor: 'rgba(33, 150, 243, 0.56)',
            bottomColor: 'rgba(33, 150, 243, 0.04)',
            lineColor: 'rgba(33, 150, 243, 1)',
            lineWidth: 1,
            lastPriceAnimation: 2
        });
    } else if(args.style == "candles") {
        series = chart.addCandlestickSeries();
    }

    const ticks = api.subscribe({
        ticks_history: args.symbol, 
        style: args.style,
        granularity: args.granularity,
        count: 1000, 
        end: "latest"         
    });

    ticks.subscribe(msg => {
        sub_id = msg.subscription.id;
        switch(msg.msg_type) {
            case "history":
                series.applyOptions({
                    priceFormat: {
                        type: 'price', precision: msg.pip_size, minMove: parseFloat("0." + "0".repeat(msg.pip_size-1) + "1")
                    }        
                });
                series.setData(msg.history.prices.map((price, i) => {
                    return { time: msg.history.times[i], value: price }
                }));
                break;
            case "candles":
                series.setData(msg.candles.map((candle) => {
                    return { time: candle.epoch, high: candle.high, low: candle.low, open: candle.open, close: candle.close };
                }));
                series.applyOptions({
                    priceFormat: {
                        type: 'price', precision: msg.pip_size, minMove: parseFloat("0." + "0".repeat(msg.pip_size-1) + "1")
                    }        
                });
                break;
            case "tick":
                series.update({ time: msg.tick.epoch, value: msg.tick.quote });
                series.setMarkers([{
                    time: msg.tick.epoch,
                    position: 'inBar',
                    color: '#ffab91',
                    shape: 'circle'
                }]);           
                break;
            case "ohlc":
                series.update({
                    time: parseInt(msg.ohlc.epoch / args.granularity) * args.granularity, 
                    high: msg.ohlc.high, 
                    low: msg.ohlc.low, 
                    open: msg.ohlc.open, 
                    close: msg.ohlc.close 
                });
                break;
        }
    });    
}

const get_active_symbols = async (args) => {
    return await api.activeSymbols("brief").then(r => {
        return r.active_symbols.map(s => {
            return {
                display_name: s.display_name,
                symbol: s.symbol,
                selected_symbol: s.symbol == args.selected_symbol
            }
        })
    });
}