/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   basic_function.c                                   :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: jmondino <marvin@42.fr>                    +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2018/08/21 16:34:08 by jmondino          #+#    #+#             */
/*   Updated: 2018/08/22 10:41:54 by jmondino         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include "header.h"

void	ft_putchar(char c)
{
	write(1, &c, 1);
}

void	ft_putstr(char *str)
{
	int i;

	i = 0;
	while (str[i])
	{
		ft_putchar(str[i]);
		i++;
	}
}

void	ft_putnbr(int nb)
{
	if (nb == -2147483648)
	{
		ft_putnbr(-214748364);
		nb = 8;
	}
	if (nb < 0)
	{
		ft_putchar(45);
		nb = -nb;
	}
	if (nb >= 10)
	{
		ft_putnbr(nb / 10);
		ft_putnbr(nb % 10);
	}
	else
		ft_putchar(nb + '0');
}

int		ft_atoi(char *str)
{
	int i;
	int nega;
	int nb;

	nb = 0;
	nega = 0;
	i = 0;
	while (str[i] <= 32)
		i++;
	if (str[i] == '-' || str[i] == '+')
	{
		if (str[i] == '-')
			nega = 1;
		i++;
		if (str[i] < '0' || str[i] > '9')
			return (0);
	}
	while ((str[i] >= '0' && str[i] <= '9') && str[i])
	{
		nb = nb * 10 + str[i] - '0';
		i++;
	}
	if (nega == 1)
		nb = -nb;
	return (nb);
}
