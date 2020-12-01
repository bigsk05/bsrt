import os,time,math
#-------------------------------------#
class Calendar(object):
    def CalcTimeJulianCent(self,JD):
        return (JD - 2451545.0)/36525.0
    def CalcJDFromJulianCent(self,t):
        return t * 36525.0 + 2451545.0
    def IsLeapYear(self,year):
        return ((year % 4 == 0 and Year % 100 != 0) or Year % 400 == 0)
    def CalcDoyFromJD(self,JD):
        z = math.floor(JD + 0.5)
        f = (JD + 0.5) - z
        if(z < 2299161):
            A = z
        else:
            alpha = math.floor((z - 1867216.25)/36524.25)
            A = z + 1 + alpha - math.floor(alpha/4)
        B = A + 1524
        C = math.floor((B - 122.1)/365.25)
        D = math.floor(365.25 * C)
        E = math.floor((B - D)/30.6001)
        day = B - D - math.floor(30.6001 * E) + f
        month = (E - 1) if(E < 14) else (E - 13)
        year = (C - 4716) if(month > 2) else (C - 4715)
        k = (1 if(self.IsLeapYear(year)) else 2)
        return math.floor((275 * month)/9) - k * math.floor((month + 9)/12) + day -30
    def RadToDeg(self,angleRad):
        return (180.0 * angleRad / math.pi)
    def degToRad(self,angleDeg):
        return (math.PI * angleDeg / 180.0)
    def CalcGeomMeanLongSun(self,t):
        L0 = 280.46646 + t * (36000.76983 + t*(0.0003032))
        while(L0 > 360.0):
            L0 -= 360.0
        while(L0 < 0.0):
            L0 += 360.0
        return L0
    def CalcGeomMeanAnomalySun(self,t):
        return 357.52911 + t * (35999.05029 - 0.0001537 * t)
    def CalcEccentricityEarthOrbit(self,t):
        return 0.016708634 - t * (0.000042037 + 0.0000001267 * t)
    def CalcSunEqOfCenter(self,t):
        m = self.calcGeomMeanAnomalySun(t)
        mrad = degToRad(m)
        sinm = math.sin(mrad)
        sin2m = math.sin(mrad+mrad)
        sin3m = math.sin(mrad+mrad+mrad)
        return sinm * (1.914602 - t * (0.004817 + 0.000014 * t)) + sin2m * (0.019993 - 0.000101 * t) + sin3m * 0.000289
    def CalcSunTrueLong(self,t):
        l0 = self.calcGeomMeanLongSun(t)
        c = self.calcSunEqOfCenter(t)
        return l0 + c
    def CalcSunTrueAnomaly(self,t):
        m = self.calcGeomMeanAnomalySun(t)
        c = self.calcSunEqOfCenter(t)
        return m + c
    def CalcSunRadVector(self,t):
        v = self.calcSunTrueAnomaly(t)
        e = self.calcEccentricityEarthOrbit(t)
        return (1.000001018 * (1 - e * e)) / (1 + e * math.cos(degToRad(v)))
    def CalcSunApparentLong(self,t):
        o = self.calcSunTrueLong(t)
        omega = 125.04 - 1934.136 * t
        return o - 0.00569 - 0.00478 * math.sin(degToRad(omega))
    def CalcMeanObliquityOfEcliptic(self,t):
        seconds = 21.448 - t*(46.8150 + t*(0.00059 - t*(0.001813)))
        e0 = 23.0 + (26.0 + (seconds/60.0))/60.0
        return e0
    def CalcObliquityCorrection(self,t):
        e0 = self.calcMeanObliquityOfEcliptic(t)
        omega = 125.04 - 1934.136 * t
        e = e0 + 0.00256 * math.cos(degToRad(omega))
        return e
    def CalcSunRtAscension(self,t):
        e = self.calcObliquityCorrection(t)
        Lambda = self.calcSunApparentLong(t)
        tananum = (math.cos(degToRad(e)) * math.sin(degToRad(Lambda)))
        tanadenom = (math.cos(degToRad(Lambda)))
        alpha = self.RadToDeg(math.atan2(tananum, tanadenom))
        return alpha
    def CalcSunDeclination(self,t):
        e = self.calcObliquityCorrection(t)
        Lambda = self.calcSunApparentLong(t)
        sint = math.sin(degToRad(e)) * math.sin(degToRad(Lambda))
        theta = self.RadToDeg(math.asin(sint))
        return theta
    def CalcEquationOfTime(self,t):
        epsilon = self.calcObliquityCorrection(t)
        l0 = self.calcGeomMeanLongSun(t)
        e = self.calcEccentricityEarthOrbit(t)
        m = self.calcGeomMeanAnomalySun(t)
        y = math.tan(degToRad(epsilon)/2.0)
        y *= y
        sin2l0 = math.sin(2.0 * degToRad(l0))
        sinm   = math.sin(degToRad(m))
        cos2l0 = math.cos(2.0 * degToRad(l0))
        sin4l0 = math.sin(4.0 * degToRad(l0))
        sin2m  = math.sin(2.0 * degToRad(m))
        Etime = y * sin2l0 - 2.0 * e * sinm + 4.0 * e * y * sinm * cos2l0 - 0.5 * y * y * sin4l0 - 1.25 * e * e * sin2m
        return self.RadToDeg(Etime)*4.0
    def CalcHourAngleSunrise(self,lat,solarDec):
        latRad = degToRad(lat)
        sdRad  = degToRad(solarDec)
        HAarg = (math.cos(degToRad(90.833))/(math.cos(latRad)*math.cos(sdRad))-math.tan(latRad) * math.tan(sdRad))
        return math.acos(HAarg)
    def GetJD(self,docmonth,docday,docyear):
        monthList = [
            {name: "January",   numdays: 31, abbr: "一月"},
            {name: "February",  numdays: 28, abbr: "二月"},
            {name: "March",     numdays: 31, abbr: "三月"},
            {name: "April",     numdays: 30, abbr: "四月"},
            {name: "May",       numdays: 31, abbr: "五月"},
            {name: "June",      numdays: 30, abbr: "六月"},
            {name: "July",      numdays: 31, abbr: "七月"},
            {name: "August",    numdays: 31, abbr: "八月"},
            {name: "September", numdays: 30, abbr: "九月"},
            {name: "October",   numdays: 31, abbr: "十月"},
            {name: "November",  numdays: 30, abbr: "十一月"},
            {name: "December",  numdays: 31, abbr: "十二月"}
        ]
        if((self.IsLeapYear(docyear)) and (docmonth == 2)):
            if(docday > 29):
                docday = 29
        else:
            if(docday > monthList[docmonth-1].numdays):
                docday = monthList[docmonth-1].numdays
        if(docmonth <= 2):
            docyear -= 1
            docmonth += 12
        A = math.floor(docyear/100)
        B = 2 - A + math.floor(A/4)
        return math.floor(365.25*(docyear + 4716)) + math.floor(30.6001*(docmonth+1)) + docday + B - 1524.5

#-------------------------------------#

print(Calendar().CalcDoyFromJD(1))