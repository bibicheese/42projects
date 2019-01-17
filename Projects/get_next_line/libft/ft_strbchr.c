/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   ft_strbchr.c                                       :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: jmondino <marvin@42.fr>                    +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2019/01/17 11:06:29 by jmondino          #+#    #+#             */
/*   Updated: 2019/01/17 13:22:53 by jmondino         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include "libft.h"

char	*ft_strbchr(char *s, int c)
{
	char	*str;
	int		i;

	i = 0;
	while (s[i] != c)
		i++;
	str = (char *)malloc(sizeof(char) * i + 1);
	i = 0;
	while (s[i])
	{
		str[i] = s[i];
		if (s[i] == c)
		{
			str[i] = '\0';
			return (str);
		}
		i++;
	}
	if (c == '\0')
		return (s);
	return (NULL);
}
