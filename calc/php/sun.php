//Tring change to php
import os,time,math
#-------------------------------------#
class Astronomy(object):
    def calcSunDeclination(self,Stamp=None,TimeZone=8):
        MonthList = [
        {"name": 'January',   "numdays": 31},
        {"name": 'February',  "numdays": 28},
        {"name": 'March',     "numdays": 31},
        {"name": 'April',     "numdays": 30},
        {"name": 'May',       "numdays": 31},
        {"name": 'June',      "numdays": 30},
        {"name": 'July',      "numdays": 31},
        {"name": 'August',    "numdays": 31},
        {"name": 'September', "numdays": 30},
        {"name": 'October',   "numdays": 31},
        {"name": 'November',  "numdays": 30},
        {"name": 'December',  "numdays": 31},
        ]
        if(Stamp==None):
            TimeStamp = time.time()
        else:
            TimeStamp = Stamp
        Year=int(time.strftime("%Y",time.localtime(TimeStamp)))
        Month=int(time.strftime("%m",time.localtime(TimeStamp)))
        Day=int(time.strftime("%d",time.localtime(TimeStamp)))
        Hour=int(time.strftime("%H",time.localtime(TimeStamp)))
        Minute=int(time.strftime("%M",time.localtime(TimeStamp)))
        Second=int(time.strftime("%S",time.localtime(TimeStamp)))
        if(((Year % 4 == 0 and Year % 100 != 0) or Year % 400 == 0) and (Month == 2)):
            if(Day > 29):
                Day=29
        else:
            if(Day > MonthList[Month-1]['numdays']):
                Day = MonthList[Month-1]['numdays']
        if(Month <= 2):
            Year -= 1
            Month += 12
        L0 = 280.46646 + ((math.floor(365.25 * (Year + 4716)) + math.floor(30.6001 * (Month + 1)) + Day + 2 - math.floor(Year / 100) + math.floor(math.floor(Year / 100) / 4) - 1524.5 + (Hour * 60 + Minute + Second/60.0) / 1440.0 - TimeZone / 24 - 2451545) / 36525) * (36000.76983 + ((math.floor(365.25 * (Year + 4716)) + math.floor(30.6001 * (Month + 1)) + Day + 2 - math.floor(Year / 100) + math.floor(math.floor(Year / 100) / 4) - 1524.5 + (Hour * 60 + Minute + Second/60.0) / 1440.0 - TimeZone / 24 - 2451545) / 36525) * (0.0003032))
        while(L0 > 360.0):
            L0 -= 360.0
        while(L0 < 0.0):
            L0 += 360.0
        return (math.degrees(math.asin(math.sin(math.radians(23 + (26 + ((21.448 - ((math.floor(365.25 * (Year + 4716)) + math.floor(30.6001 * (Month + 1)) + Day + 2 - math.floor(Year / 100) + math.floor(math.floor(Year / 100) / 4) - 1524.5 + (Hour * 60 + Minute + Second/60.0) / 1440.0 - TimeZone / 24 - 2451545) / 36525) * (46.8150 + ((math.floor(365.25 * (Year + 4716)) + math.floor(30.6001 * (Month + 1)) + Day + 2 - math.floor(Year / 100) + math.floor(math.floor(Year / 100) / 4) - 1524.5 + (Hour * 60 + Minute + Second/60.0) / 1440.0 - TimeZone / 24 - 2451545) / 36525) * (0.00059 - ((math.floor(365.25 * (Year + 4716)) + math.floor(30.6001 * (Month + 1)) + Day + 2 - math.floor(Year / 100) + math.floor(math.floor(Year / 100) / 4) - 1524.5 + (Hour * 60 + Minute + Second/60.0) / 1440.0 - TimeZone / 24 - 2451545) / 36525) * (0.001813)))) / 60.0)) / 60.0 + 0.00256 * math.cos(math.radians(1254 - 1934.136 * ((math.floor(365.25 * (Year + 4716)) + math.floor(30.6001 * (Month + 1)) + Day + 2 - math.floor(Year / 100) + math.floor(math.floor(Year / 100) / 4) - 1524.5 + (Hour * 60 + Minute + Second/60.0) / 1440.0 - TimeZone / 24 - 2451545) / 36525))))) * math.sin(math.radians(L0 + math.sin(math.radians(357.52911 + ((math.floor(365.25 * (Year + 4716)) + math.floor(30.6001 * (Month + 1)) + Day + 2 - math.floor(Year / 100) + math.floor(math.floor(Year / 100) / 4) - 1524.5 + (Hour * 60 + Minute + Second/60.0) / 1440.0 - TimeZone / 24 - 2451545) / 36525) * (359995029 - 0.0001537 * ((math.floor(365.25 * (Year + 4716)) + math.floor(30.6001 * (Month + 1)) + Day + 2 - math.floor(Year / 100) + math.floor(math.floor(Year / 100) / 4) - 1524.5 + (Hour * 60 + Minute + Second/60.0) / 1440.0 - TimeZone / 24 - 2451545) / 36525)))) * (1.914602 - ((math.floor(365.25 * (Year + 4716)) + math.floor(30.6001 * (Month + 1)) + Day + 2 - math.floor(Year / 100) + math.floor(math.floor(Year / 100) / 4) - 1524.5 + (Hour * 60 + Minute + Second/60.0) / 1440.0 - TimeZone / 24 - 2451545) / 36525) * (0.004817 + 0.000014 * ((math.floor(365.25 * (Year + 4716)) + math.floor(30.6001 * (Month + 1)) + Day + 2 - math.floor(Year / 100) + math.floor(math.floor(Year / 100) / 4) - 1524.5 + (Hour * 60 + Minute + Second/60.0) / 1440.0 - TimeZone / 24 - 2451545) / 36525))) + math.sin(math.radians(357.52911 + ((math.floor(365.25 * (Year + 4716)) + math.floor(30.6001 * (Month + 1)) + Day + 2 - math.floor(Year / 100) + math.floor(math.floor(Year / 100) / 4) - 1524.5 + (Hour * 60 + Minute + Second/60.0) / 1440.0 - TimeZone / 24 - 2451545) / 36525) * (359995029 - 0.0001537 * ((math.floor(365.25 * (Year + 4716)) + math.floor(30.6001 * (Month + 1)) + Day + 2 - math.floor(Year / 100) + math.floor(math.floor(Year / 100) / 4) - 1524.5 + (Hour * 60 + Minute + Second/60.0) / 1440.0 - TimeZone / 24 - 2451545) / 36525))) * 2) * (0.019993 - 0.000101 * ((math.floor(365.25 * (Year + 4716)) + math.floor(30.6001 * (Month + 1)) + Day + 2 - math.floor(Year / 100) + math.floor(math.floor(Year / 100) / 4) - 1524.5 + (Hour * 60 + Minute + Second/60.0) / 1440.0 - TimeZone / 24 - 2451545) / 36525)) + math.sin(math.radians(357.52911 + ((math.floor(365.25 * (Year + 4716)) + math.floor(30.6001 * (Month + 1)) + Day + 2 - math.floor(Year / 100) + math.floor(math.floor(Year / 100) / 4) - 1524.5 + (Hour * 60 + Minute + Second/60.0) / 1440.0 - TimeZone / 24 - 2451545) / 36525) * (359995029 - 0.0001537 * ((math.floor(365.25 * (Year + 4716)) + math.floor(30.6001 * (Month + 1)) + Day + 2 - math.floor(Year / 100) + math.floor(math.floor(Year / 100) / 4) - 1524.5 + (Hour * 60 + Minute + Second/60.0) / 1440.0 - TimeZone / 24 - 2451545) / 36525))) * 3) * 0.000289 - 0.00569 - 0.00478 * math.sin(math.radians(1254 - 1934.136 * ((math.floor(365.25 * (Year + 4716)) + math.floor(30.6001 * (Month + 1)) + Day + 2 - math.floor(Year / 100) + math.floor(math.floor(Year / 100) / 4) - 1524.5 + (Hour * 60 + Minute + Second/60.0) / 1440.0 - TimeZone / 24 - 2451545) / 36525))))))) * 100 + 0.5) / 100.0
    def calcHourAngle(self,Stamp=None,Lon=120,TimeZone=8):
        MonthList = [
        {"name": 'January',   "numdays": 31},
        {"name": 'February',  "numdays": 28},
        {"name": 'March',     "numdays": 31},
        {"name": 'April',     "numdays": 30},
        {"name": 'May',       "numdays": 31},
        {"name": 'June',      "numdays": 30},
        {"name": 'July',      "numdays": 31},
        {"name": 'August',    "numdays": 31},
        {"name": 'September', "numdays": 30},
        {"name": 'October',   "numdays": 31},
        {"name": 'November',  "numdays": 30},
        {"name": 'December',  "numdays": 31},
        ]
        if(Stamp==None):
            TimeStamp = time.time()
        else:
            TimeStamp = Stamp
        Year=int(time.strftime("%Y",time.localtime(TimeStamp)))
        Month=int(time.strftime("%m",time.localtime(TimeStamp)))
        Day=int(time.strftime("%d",time.localtime(TimeStamp)))
        Hour=int(time.strftime("%H",time.localtime(TimeStamp)))
        Minute=int(time.strftime("%M",time.localtime(TimeStamp)))
        Second=int(time.strftime("%S",time.localtime(TimeStamp)))
        if(((Year % 4 == 0 and Year % 100 != 0) or Year % 400 == 0) and (Month == 2)):
            if(Day > 29):
                Day=29
        else:
            if(Day > MonthList[Month-1]['numdays']):
                Day = MonthList[Month-1]['numdays']
        if(Month <= 2):
            Year -= 1
            Month += 12
        TimeJulianCent = (math.floor(365.25*(Year + 4716)) + math.floor(30.6001*(Month+1)) + Day + 2 - math.floor(Year/100) + math.floor(math.floor(Year/100)/4) - 1524.5 + Hour * 60 + Minute + Second/60.0/1440.0 - TimeZone/24 - 2451545)/36525
        L0 = 280.46646 + TimeJulianCent * (36000.76983 + TimeJulianCent *(0.0003032))
        while(L0 > 360.0):
            L0 -= 360.0
        while(L0 < 0.0):
            L0 += 360.0
        TrueSolarTime = (Hour * 60 + Minute + Second / 60) + ((4 * math.degrees((math.tan(math.radians((23 + (26 + ((21.448 - TimeJulianCent * (46.8150 + TimeJulianCent * (0.00059 - TimeJulianCent * (0.001813)))) / 60.0)) / 60.0 + 0.00256 * math.cos(math.radians(1254 - 1934.136 * TimeJulianCent))))/2) ** 2) * math.sin(2 * math.radians(L0)) - 2 * (0.016708634 - TimeJulianCent * (0.000042037 + 0.0000001267 * TimeJulianCent)) * math.sin(math.radians(357.52911 + TimeJulianCent * (359995029 - 0.0001537 * TimeJulianCent))) + 4 * (0.016708634 - TimeJulianCent * (0.000042037 + 0.0000001267 * TimeJulianCent)) * (math.tan(math.radians((23 + (26 + ((21.448 - TimeJulianCent * (46.8150 + TimeJulianCent * (0.00059 - TimeJulianCent * (0.001813)))) / 60.0)) / 60.0 + 0.00256 * math.cos(math.radians(1254 - 1934.136 * TimeJulianCent)))) / 2) ** 2) * math.sin(math.radians(357.52911 + TimeJulianCent * (359995029 - 0.0001537 * TimeJulianCent))) * math.cos(2 * math.radians(L0)) - 0.5 * (math.tan(math.radians((23 + (26 + ((21.448 - TimeJulianCent * (46.8150 + TimeJulianCent * (0.00059 - TimeJulianCent * (0.001813)))) / 60.0)) / 60.0 + 0.00256 * math.cos(math.radians(1254 - 1934.136 * TimeJulianCent))))/2) ** 2) * (math.tan(math.radians((23 + (26 + ((21.448 - TimeJulianCent * (46.8150 + TimeJulianCent * (0.00059 - TimeJulianCent * (0.001813)))) / 60.0)) / 60.0 + 0.00256 * math.cos(math.radians(1254 - 1934.136 * TimeJulianCent))))/2) ** 2) * math.sin(4 * math.radians(L0)) - 1.25 * ((0.016708634 - TimeJulianCent * (0.000042037 + 0.0000001267 * TimeJulianCent)) ** 2) * math.sin(2 * math.radians(math.radians(357.52911 + TimeJulianCent * (359995029 - 0.0001537 * TimeJulianCent)))))) + 4 * Lon - 60.0 * TimeZone)
        while (TrueSolarTime > 1440):
            TrueSolarTime -= 1440
        HourAngle = TrueSolarTime / 4 - 180.0
        if (HourAngle < -180):
            HourAngle += 360.0
        return HourAngle
    def calcSunAzEl(self,Stamp=None,Lon=120,Lat=30,TimeZone=8,ZeroAzimuth="North"):
        MonthList = [
        {"name": 'January',   "numdays": 31},
        {"name": 'February',  "numdays": 28},
        {"name": 'March',     "numdays": 31},
        {"name": 'April',     "numdays": 30},
        {"name": 'May',       "numdays": 31},
        {"name": 'June',      "numdays": 30},
        {"name": 'July',      "numdays": 31},
        {"name": 'August',    "numdays": 31},
        {"name": 'September', "numdays": 30},
        {"name": 'October',   "numdays": 31},
        {"name": 'November',  "numdays": 30},
        {"name": 'December',  "numdays": 31},
        ]
        if(Stamp==None):
            TimeStamp = time.time()
        else:
            TimeStamp = Stamp
        Year=int(time.strftime("%Y",time.localtime(TimeStamp)))
        Month=int(time.strftime("%m",time.localtime(TimeStamp)))
        Day=int(time.strftime("%d",time.localtime(TimeStamp)))
        Hour=int(time.strftime("%H",time.localtime(TimeStamp)))
        Minute=int(time.strftime("%M",time.localtime(TimeStamp)))
        Second=int(time.strftime("%S",time.localtime(TimeStamp)))
        if(((Year % 4 == 0 and Year % 100 != 0) or Year % 400 == 0) and (Month == 2)):
            if(Day > 29):
                Day=29
        else:
            if(Day > MonthList[Month-1]['numdays']):
                Day = MonthList[Month-1]['numdays']
        if(Month <= 2):
            Year -= 1
            Month += 12
        ZeroAzimuth=180 if(ZeroAzimuth=="South") else 0
        csz = math.sin(math.radians(Lat)) * math.sin(math.radians(self.calcSunDeclination(Stamp,TimeZone))) + math.cos(math.radians(Lat)) * math.cos(math.radians(self.calcSunDeclination(Stamp,TimeZone))) * math.cos(math.radians(self.calcHourAngle(Stamp,Lon,TimeZone)))
        if(csz > 1):
            csz = 1
        elif(csz < -1):
            csz = -1
        if(abs((math.cos(math.radians(Lat)) * math.sin(math.radians(math.degrees(math.acos(csz)))))) > 0.001):
            azRad = ((math.sin(math.radians(Lat)) * math.cos(math.radians(math.degrees(math.acos(csz))))) - math.sin(math.radians(self.calcSunDeclination(Stamp,TimeZone)))) / (math.cos(math.radians(Lat)) * math.sin(math.radians(math.degrees(math.acos(csz)))))
            if(abs(azRad) > 1.0):
                if(azRad < 0):
                    azRad = -1.0
                else:
                    azRad = 1.0
            azimuth = 180.0 - math.degrees(math.acos(azRad))
            if(self.calcHourAngle(Stamp,Lon,TimeZone) > 0.0):
                azimuth = -azimuth
        else:
            if(Lat > 0.0):
                azimuth = 180.0
            else:
                azimuth = 0.0
        if(azimuth < 0.0):
            azimuth += 360.0
        exoatmElevation = (90.0 - math.degrees(math.acos(csz)))
        if (exoatmElevation > 85.0):
            refractionCorrection = 0.0
        else:
            te = math.tan (math.radians(exoatmElevation))
            if (exoatmElevation > 5.0):
                refractionCorrection = 58.1 / te - 0.07 / (te*te*te) + 0.000086 / (te*te*te*te*te)
            elif (exoatmElevation > -0.575):
                refractionCorrection = 1735.0 + exoatmElevation * (-518.2 + exoatmElevation * (103.4 + exoatmElevation * (-12.79 + exoatmElevation * 0.711) ) )
            else:
                refractionCorrection = -20.774 / te
            refractionCorrection = refractionCorrection / 3600.0
        solarZen = math.degrees(math.acos(csz)) - refractionCorrection
        return {"az":((azimuth*100 +0.5) - (ZeroAzimuth*100))/100.0,"el":((90.0-solarZen)*100+0.5)/100.0}