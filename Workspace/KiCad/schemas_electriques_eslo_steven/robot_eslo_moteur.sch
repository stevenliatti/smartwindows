EESchema Schematic File Version 2
LIBS:power
LIBS:device
LIBS:transistors
LIBS:conn
LIBS:linear
LIBS:regul
LIBS:74xx
LIBS:cmos4000
LIBS:adc-dac
LIBS:memory
LIBS:xilinx
LIBS:special
LIBS:microcontrollers
LIBS:dsp
LIBS:microchip
LIBS:analog_switches
LIBS:motorola
LIBS:texas
LIBS:intel
LIBS:audio
LIBS:interface
LIBS:digital-audio
LIBS:philips
LIBS:display
LIBS:cypress
LIBS:siliconi
LIBS:opto
LIBS:atmel
LIBS:contrib
LIBS:valves
LIBS:robot_eslo
LIBS:robot_eslo_moteur-cache
EELAYER 27 0
EELAYER END
$Descr A4 11693 8268
encoding utf-8
Sheet 1 1
Title "Projet_ESLO_moteurs"
Date "23 jun 2016"
Rev ""
Comp "HEPIA"
Comment1 "Blazevic & Liatti"
Comment2 ""
Comment3 ""
Comment4 ""
$EndDescr
$Comp
L BASYS_2 U1
U 1 1 576BF46B
P 5050 3350
F 0 "U1" H 4600 2500 60  0000 C CNN
F 1 "BASYS_2" H 4700 4650 60  0000 C CNN
F 2 "~" H 5050 3350 60  0000 C CNN
F 3 "~" H 5050 3350 60  0000 C CNN
	1    5050 3350
	1    0    0    -1  
$EndComp
$Comp
L SN754410 U3
U 1 1 576BF48F
P 7650 3450
F 0 "U3" H 7850 2900 60  0000 C CNN
F 1 "SN754410" H 7600 4000 60  0000 C CNN
F 2 "~" H 7650 3450 60  0000 C CNN
F 3 "~" H 7650 3450 60  0000 C CNN
	1    7650 3450
	1    0    0    -1  
$EndComp
$Comp
L DC_MOT M2
U 1 1 576BF713
P 8650 3450
F 0 "M2" H 8650 3450 98  0000 C CNN
F 1 "DC_MOT" H 9000 3450 60  0000 C CNN
F 2 "~" H 8650 3450 60  0000 C CNN
F 3 "~" H 8650 3450 60  0000 C CNN
	1    8650 3450
	1    0    0    -1  
$EndComp
$Comp
L DC_MOT M1
U 1 1 576BF75B
P 6700 3450
F 0 "M1" H 6700 3450 98  0000 C CNN
F 1 "DC_MOT" H 6350 3450 60  0000 C CNN
F 2 "~" H 6700 3450 60  0000 C CNN
F 3 "~" H 6700 3450 60  0000 C CNN
	1    6700 3450
	1    0    0    -1  
$EndComp
$Comp
L GND #PWR?
U 1 1 576BF7D0
P 4200 2500
F 0 "#PWR?" H 4200 2500 30  0001 C CNN
F 1 "GND" H 4200 2430 30  0001 C CNN
F 2 "" H 4200 2500 60  0000 C CNN
F 3 "" H 4200 2500 60  0000 C CNN
	1    4200 2500
	1    0    0    -1  
$EndComp
$Comp
L +3.3V #PWR?
U 1 1 576BF7DF
P 4200 2150
F 0 "#PWR?" H 4200 2110 30  0001 C CNN
F 1 "+3.3V" H 4200 2260 30  0000 C CNN
F 2 "" H 4200 2150 60  0000 C CNN
F 3 "" H 4200 2150 60  0000 C CNN
	1    4200 2150
	1    0    0    -1  
$EndComp
$Comp
L +3.3V #PWR?
U 1 1 576BF813
P 8250 3000
F 0 "#PWR?" H 8250 2960 30  0001 C CNN
F 1 "+3.3V" H 8250 3110 30  0000 C CNN
F 2 "" H 8250 3000 60  0000 C CNN
F 3 "" H 8250 3000 60  0000 C CNN
	1    8250 3000
	1    0    0    -1  
$EndComp
$Comp
L +3.3V #PWR?
U 1 1 576BF82E
P 7200 3950
F 0 "#PWR?" H 7200 3910 30  0001 C CNN
F 1 "+3.3V" H 7200 4060 30  0000 C CNN
F 2 "" H 7200 3950 60  0000 C CNN
F 3 "" H 7200 3950 60  0000 C CNN
	1    7200 3950
	1    0    0    -1  
$EndComp
$Comp
L GND #PWR?
U 1 1 576BF855
P 8400 3450
F 0 "#PWR?" H 8400 3450 30  0001 C CNN
F 1 "GND" H 8400 3380 30  0001 C CNN
F 2 "" H 8400 3450 60  0000 C CNN
F 3 "" H 8400 3450 60  0000 C CNN
	1    8400 3450
	1    0    0    -1  
$EndComp
$Comp
L GND #PWR?
U 1 1 576BF8A4
P 6950 3450
F 0 "#PWR?" H 6950 3450 30  0001 C CNN
F 1 "GND" H 6950 3380 30  0001 C CNN
F 2 "" H 6950 3450 60  0000 C CNN
F 3 "" H 6950 3450 60  0000 C CNN
	1    6950 3450
	1    0    0    -1  
$EndComp
Wire Wire Line
	8250 3400 8250 3500
Wire Wire Line
	7050 3400 7050 3500
Wire Wire Line
	8650 3250 8650 3200
Wire Wire Line
	8650 3200 8450 3200
Wire Wire Line
	8450 3200 8450 3300
Wire Wire Line
	8450 3300 8250 3300
Wire Wire Line
	8250 3600 8450 3600
Wire Wire Line
	8450 3700 8650 3700
Wire Wire Line
	8650 3700 8650 3650
Wire Wire Line
	8450 3600 8450 3700
Wire Wire Line
	6700 3250 6700 3200
Wire Wire Line
	6700 3200 6900 3200
Wire Wire Line
	6900 3200 6900 3300
Wire Wire Line
	6900 3300 7050 3300
Wire Wire Line
	6700 3650 6700 3700
Wire Wire Line
	6700 3700 6900 3700
Wire Wire Line
	6900 3700 6900 3600
Wire Wire Line
	6900 3600 7050 3600
Wire Wire Line
	4200 2150 4200 2300
Wire Wire Line
	4200 2400 4200 2500
Wire Wire Line
	8250 3000 8250 3100
Wire Wire Line
	7050 3800 7050 3950
Wire Wire Line
	7050 3950 7200 3950
Wire Wire Line
	8400 3400 8400 3450
Wire Wire Line
	8400 3400 8250 3400
Wire Wire Line
	6950 3450 6950 3400
Wire Wire Line
	6950 3400 7050 3400
Connection ~ 7050 3400
Connection ~ 8250 3400
Wire Wire Line
	6100 2800 5800 2800
Wire Wire Line
	6150 2900 5800 2900
Wire Wire Line
	7050 3100 5850 3100
Wire Wire Line
	5850 3100 5850 3550
Wire Wire Line
	5850 3550 5800 3550
Wire Wire Line
	5800 3650 6525 3650
Wire Wire Line
	6525 3650 6525 4125
Wire Wire Line
	6525 4125 8250 4125
Wire Wire Line
	8250 4125 8250 3800
Wire Wire Line
	7050 3200 7050 3150
Wire Wire Line
	7050 3150 5925 3150
Wire Wire Line
	5925 3150 5925 3900
Wire Wire Line
	5925 3900 5800 3900
Wire Wire Line
	5975 3775 5975 4000
Wire Wire Line
	5975 4000 5800 4000
Wire Wire Line
	8250 3200 8350 3200
Wire Wire Line
	8350 3200 8350 3050
Wire Wire Line
	8350 3050 9350 3050
Wire Wire Line
	9350 3050 9350 4275
Wire Wire Line
	9350 4275 6425 4275
Wire Wire Line
	6425 4275 6425 4100
Wire Wire Line
	6425 4100 5800 4100
Wire Wire Line
	5800 4200 8375 4200
Wire Wire Line
	8375 4200 8375 3700
Wire Wire Line
	8375 3700 8250 3700
Wire Wire Line
	7050 3700 6950 3700
Wire Wire Line
	6950 3700 6950 3775
Wire Wire Line
	6950 3775 5975 3775
Text GLabel 6150 2675 2    60   Input ~ 0
UART_RX
Text GLabel 6150 2900 2    60   Input ~ 0
UART_TX
Wire Wire Line
	6150 2675 6100 2675
Wire Wire Line
	6100 2675 6100 2800
$EndSCHEMATC
